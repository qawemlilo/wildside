

<?php
// Function    : pdf2txt()
// Arguments   : $filename - Filename of the PDF you want to extract
// Description : Reads a pdf file, extracts data streams, and manages
//               their translation to plain text - returning the plain
//               text at the end
// Authors      : Jonathan Beckett, 2005-05-02
//                            : Sven Schuberth, 2007-03-29




function pdf2txt($filename){

    $data = getFileData($filename);
    
    $s=strpos($data,"%")+1;
    
    $version=substr($data,$s,strpos($data,"%",$s)-1);
    if(substr_count($version,"PDF-1.2")==0)
        return handleV3($data);
    else
        return handleV2($data);

    
}
// handles the verson 1.2
function handleV2($data){
        
    // grab objects and then grab their contents (chunks)
    $a_obj = getDataArray($data,"obj","endobj");
    
    foreach($a_obj as $obj){
        
        $a_filter = getDataArray($obj,"<<",">>");
    
        if (is_array($a_filter)){
            $j++;
            $a_chunks[$j]["filter"] = $a_filter[0];

            $a_data = getDataArray($obj,"stream\r\n","endstream");
            if (is_array($a_data)){
                $a_chunks[$j]["data"] = substr($a_data[0],
strlen("stream\r\n"),
strlen($a_data[0])-strlen("stream\r\n")-strlen("endstream"));
            }
        }
    }

    // decode the chunks
    foreach($a_chunks as $chunk){

        // look at each chunk and decide how to decode it - by looking at the contents of the filter
        $a_filter = split("/",$chunk["filter"]);
        
        if ($chunk["data"]!=""){
            // look at the filter to find out which encoding has been used            
            if (substr($chunk["filter"],"FlateDecode")!==false){
                $data =@ gzuncompress($chunk["data"]);
                if (trim($data)!=""){
                    $result_data .= ps2txt($data);
                } else {
                
                    //$result_data .= "x";
                }
            }
        }
    }
    
    return $result_data;
}

//handles versions >1.2
function handleV3($data){
    // grab objects and then grab their contents (chunks)
    $a_obj = getDataArray($data,"obj","endobj");
    $result_data="";
    foreach($a_obj as $obj){
        //check if it a string
        if(substr_count($obj,"/GS1")>0){
            //the strings are between ( and )
            preg_match_all("|\((.*?)\)|",$obj,$field,PREG_SET_ORDER);
            if(is_array($field))
                foreach($field as $data)
                    $result_data.=$data[1];
        }
    }
    return $result_data;
}

function ps2txt($ps_data){
    $result = "";
    $a_data = getDataArray($ps_data,"[","]");
    if (is_array($a_data)){
        foreach ($a_data as $ps_text){
            $a_text = getDataArray($ps_text,"(",")");
            if (is_array($a_text)){
                foreach ($a_text as $text){
                    $result .= substr($text,1,strlen($text)-2);
                }
            }
        }
    } else {
        // the data may just be in raw format (outside of [] tags)
        $a_text = getDataArray($ps_data,"(",")");
        if (is_array($a_text)){
            foreach ($a_text as $text){
                $result .= substr($text,1,strlen($text)-2);
            }
        }
    }
    return $result;
}

function getFileData($filename){
    $handle = fopen($filename,"rb");
    $data = fread($handle, filesize($filename));
    fclose($handle);
    return $data;
}

function getDataArray($data,$start_word,$end_word){

    $start = 0;
    $end = 0;
    unset($a_result);
    
    while ($start!==false && $end!==false){
        $start = strpos($data,$start_word,$end);
        if ($start!==false){
            $end = strpos($data,$end_word,$start);
            if ($end!==false){
                // data is between start and end
                $a_result[] = substr($data,$start,$end-$start+strlen($end_word));
            }
        }
    }
    return $a_result;
}
?>