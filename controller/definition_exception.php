<?php

class EmptyValueException extends Exception{
  function printMessage(){
    echo "<script>
            alert('입력되지 않은 필수 항목이 존재합니다.');
            history.go(-1);
          </script>";
  }
}


class WrongTypeException extends Exception{
  function printMessage(){
    echo "<script>
            alert('잘못된 형태의 값이 입력되었습니다.');
            history.go(-1);
          </script>";
  }
}




 ?>
