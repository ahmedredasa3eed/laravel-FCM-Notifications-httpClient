<?php

 function upload($request,$name,$path){
    if($request->file($name)){
        $file= $request->file($name);
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path($path), $filename);
        return $filename;
    }
}

?>
