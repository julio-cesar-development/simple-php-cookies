<?php
  Class HandleCharacters {
    public function ant_sql($sql) {
      $sql = strToLower($sql);
      $sql = preg_replace('/[^(a-z|0-9|\s|_)]+/i', '', $sql);
      $sql = preg_replace('/(from|select|insert|delete|where|drop|alter|alter table|drop table|show tables)+/i', '', $sql);
      $sql = trim($sql);
      $sql = strip_tags($sql);
      $sql = addslashes($sql);
      return $sql;
    }

    public function ant_sql_pass($sql) {
      $sql = preg_replace('/\s+/i', '', $sql);
      $sql = preg_replace('/(from|select|insert|delete|where|drop|alter|alter table|drop table|show tables)+/i', '', $sql);
      $sql = trim($sql);
      $sql = strip_tags($sql);
      $sql = addslashes($sql);
      return $sql;
    }

    public function replace_characters($str) {
      $str = str_replace('ã', '&atilde;', $str);
      $str = str_replace('õ', '&otilde;', $str);
      $str = str_replace('ç', '&ccedil;', $str);
      $str = str_replace('á', '&aacute;', $str);
      $str = str_replace('é', '&eacute;', $str);
      $str = str_replace('í', '&iacute;', $str);
      $str = str_replace('ó', '&oacute;', $str);
      $str = str_replace('ú', '&uacute;', $str);
      $str = str_replace('ê', '&ecirc;', $str);
      $str = str_replace('ô', '&ocirc;', $str);
      $str = str_replace('ñ', '&ntilde;', $str);
      $str = str_replace('û', '&ucirc;', $str);
      $str = str_replace('à', '&agrave;', $str);
      $str = str_replace('è', '&egrave;', $str);
      $str = str_replace('ì', '&igrave;', $str);
      $str = str_replace('ò', '&ograve;', $str);
      $str = str_replace('ù', '&ugrave;', $str);
      $str = str_replace('î', '&icirc;', $str);
      $str = str_replace('\'', ' ', $str);
      $str = str_replace('"', ' ', $str);
      $str = addslashes($str);
      return $str;
    }
  }
?>
