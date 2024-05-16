<?php
defined('BASEPATH') or exit('No direct script access allowed');
function data($data)
{
  
return date('d/m/Y', strtotime($data)); //mostrará dd/mm/yyyy H:i:s.

}

