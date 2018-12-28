<?php
  
  Class HandleCharacters {
  
    function ant_sql($sql) {
      
      $sql = strToLower($sql);
      $sql = preg_replace("/[^(a-z|0-9|\s|_)]+/i", "", $sql); // substitui n�o alfanum�ricos
      $sql = preg_replace("/(from|select|insert|delete|where|drop|alter|alter table|drop table|show tables)+/i", "", $sql); // substitui comandos sql
      $sql = trim($sql); // remove espa�os antes e depois da string
      $sql = strip_tags($sql); // remove tags html e php
      $sql = addslashes($sql); // escapa (adiciona barras invertidas)
      
      return $sql;
    }
    

    function ant_sql_pass($sql) {
      
      $sql = preg_replace("/(from|select|insert|delete|where|drop|alter|alter table|drop table|show tables)+/i", "", $sql); // substitui comandos sql
      $sql = trim($sql); // remove espa�os antes e depois da string
      $sql = strip_tags($sql); // remove tags html e php
      $sql = addslashes($sql); // escapa (adiciona barras invertidas)
      
      return $sql;
    }

    function substituicaracteres($itemalt){
      
      $itemalt=str_replace("�","&atilde;",$itemalt);
      $itemalt=str_replace("�","&atilde;",$itemalt);
      $itemalt=str_replace("�","&otilde;",$itemalt);
      $itemalt=str_replace("�","&ccedil;",$itemalt);
      $itemalt=str_replace("�","&aacute;",$itemalt);
      $itemalt=str_replace("�","&eacute;",$itemalt);
      $itemalt=str_replace("�","&iacute;",$itemalt);
      $itemalt=str_replace("�","&oacute;",$itemalt);
      $itemalt=str_replace("�","&uacute;",$itemalt);
      $itemalt=str_replace("�","&ecirc;",$itemalt);
      $itemalt=str_replace("�","&ocirc;",$itemalt);
      
      $itemalt=str_replace("�","&ntilde;",$itemalt);
      $itemalt=str_replace("�","&ucirc;",$itemalt);
      $itemalt=str_replace("�","&agrave;",$itemalt);
      $itemalt=str_replace("�","&egrave;",$itemalt);
      $itemalt=str_replace("�","&igrave;",$itemalt);
      $itemalt=str_replace("�","&ograve;",$itemalt);
      $itemalt=str_replace("�","&ugrave;",$itemalt);
      $itemalt=str_replace("�","&icirc;",$itemalt);
      
      //$itemalt=str_replace("'"," ",$itemalt);
      $itemalt = addslashes($itemalt); 
      
      return $itemalt;
    }
    
  }
  
?>
