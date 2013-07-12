<?php

/** encodes a yii CModel or array of CModels
  *
  * calling json_encode() on a yii model is not sufficient because it only
  * encodes public properties and not attributes, i.e., column values.  This
  * modifier is necessary to encode both the public properties and attributes
  *
  * @param mixed $output is an array of CModel objects or a single CModel
  *     object.
  * @return string a json-encoded model.
  */
function smarty_modifier_json_encode_model($output) {
    if(is_array($output)) {
        $return = '[';
        $first = true;
        foreach($output as $model) {
            if(!$first) $return .= ',';
            $first = false;
            $return .= doEncodeModel($model);
        }
        return $return . ']';
    }
    elseif(!is_a($output,'CModel')) {
        throw new Exception("Invalid thing passed to json_encode_model");
    }
    return doEncodeModel($output);
} // function smarty_outputfilter_json_encode_model($output,&$smarty)

function doEncodeModel(CModel $model) {
    $return = '{';
    $first = true;
    foreach(get_object_vars($model) as $name => $value) {
        if(!$first) $return .= ',';
        $first = false;
        $return .= json_encode($name);
        $return .= ':';
        $return .= json_encode($value);
    }
    foreach($model->attributes as $name => $value) {
        if(!$first) $return .= ',';
        $first = false;
        $return .= json_encode($name);
        $return .= ':';
        $return .= json_encode($value);
    }
    $return .= '}';
    return $return;
} // function doEncodeModel($model)
