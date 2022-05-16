<?php

namespace App\Traits;

trait ApiResponseTrait
{


    public function returnErrorResponse($msg="",$error_code="")
    {
        return response()->json([
            'status' => false,
            'error_code' => $error_code,
            'msg' => $msg
        ]);
    }


    public function returnSuccessMessage($msg="",$success_code="S-200")
    {
        return [
            'status' => true,
            'success_code' => $success_code,
            'msg' => $msg
        ];
    }

    public function returnResponseData($key, $value, $msg="",$success_code="S-200")
    {
        return response()->json([
            'status' => true,
            'success_code' => $success_code,
            'msg' => $msg,
            $key => $value
        ]);
    }


    //////////////////

    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        return $code = $this->getErrorCode($inputs[0]);
    }

    public function returnValidationError($code = "E001", $validator)
    {
        return $this->returnErrorResponse($code, $validator->errors()->first());
    }




    public function getErrorCode($input)
    {
        if ($input == "name")
            return 'E001';

        else if ($input == "email")
            return 'E002';

        else if ($input == "password")
            return 'E002';

        else if ($input == "mobile")
            return 'E003';

        else
            return "";
    }


}
