<?php

namespace App\Libs;


use Valitron\Validator;

use App\Exception\SalesException;

class ReqValidator
{
  /**
   * 
   * @param array 
   * @return true 
   * @throws \Exception
   */
  public function formData($data)
  {
    $v = new Validator($data);
    $v->rule('required', ['startdate', 'enddate', 'download_action']);
    $v->rule('date', ['startdate', 'enddate']);
    if (!$v->validate()) {
      $array = array_values($v->errors());
      /**
       *  throw first error
       */
      foreach ($v->errors() as $error) {
        throw new SalesException($array[0][0]);
      }
    }

    return true;
  }
}
