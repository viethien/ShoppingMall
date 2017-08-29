<?php

class Database{

  private $hostname = "localhost";
  private $user_name = "root";
  private $password = "";
  private $db_name = "shopping_mall";

  public $pdo;

  public $product_results = array();
  public $board_results = array();



  function connect(){
    try {

      $this->pdo = new PDO("mysql:host = $this->hostname;dbname=$this->db_name",$this->user_name,$this->password);  //pdo객체생성

    } catch (Exception $e) {
      echo $e->getMessage();
    }

    return $this->pdo;

  }

  function disconnect(){
    $this->pdo=NULL;
  }  //?????
// ===================================공통=================================

//조회수

  function view_increment(){

  }








// ==================================product=============================
  function product_insert($arg_title,$arg_name,$arg_category,$arg_stock,$arg_price,$arg_deliver_price,$arg_point,$arg_content){

    $query = "INSERT INTO product(title,product_name,price,deliver_price,type,point,stock,view) ";
    $query .= "VALUES(:title,:name,:price,:deliver_price,:type,:point,:stock,0)";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":title",$arg_title, PDO::PARAM_STR);
    $stmt->bindParam(":name",$arg_name, PDO::PARAM_STR);
    $stmt->bindParam(":price",$arg_price, PDO::PARAM_INT);
    $stmt->bindParam(":deliver_price",$arg_deliver_price, PDO::PARAM_INT);
    $stmt->bindParam(":type",$arg_category, PDO::PARAM_STR);
    $stmt->bindParam(":point",$arg_point, PDO::PARAM_INT);
    $stmt->bindParam(":stock",$arg_stock, PDO::PARAM_INT);

    $stmt->execute();

  }

  function insert_product_select($arg_title,$arg_name){
    //내림차순한 이유는 제목과 상품명이 동일한 아이템이 있을 수 있기때문
    //중복처리를 한다면 필요 없다.
    $query = "SELECT no FROM product WHERE title = :title AND product_name = :name ORDER BY no DESC" ;
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":title",$arg_title, PDO::PARAM_STR);
    $stmt->bindParam(":name",$arg_name, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);  //인덱스로 접근.


    return $stmt->fetch();

  }


  function image_insert($arg_no,$arg_f_name,$arg_f_extension,$arg_f_size,$arg_f_path){
    $query = "INSERT INTO images(no,image_name,image_extension,image_size,image_path)";
    $query.= " VALUES(:no, :name, :extension, :size, :path)";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":no",$arg_no, PDO::PARAM_INT);
    $stmt->bindParam(":name",$arg_f_name, PDO::PARAM_STR);
    $stmt->bindParam(":extension",$arg_f_extension, PDO::PARAM_STR);
    $stmt->bindParam(":size",$arg_f_size, PDO::PARAM_INT);
    $stmt->bindParam(":path",$arg_f_path, PDO::PARAM_STR);
    $stmt->execute();
  }




  function show_product_select($arg_product_type,$arg_sort_type,$arg_order_type){
    if($arg_sort_type==""){
      $sort_type = 'time';
    }else{
      $sort_type = $arg_sort_type;
    }

    // $query = "SELECT * FROM product WHERE type = :type ORDER BY {$sort_type} {$arg_order_type} ";
    $query = "SELECT p.no,p.title,p.price,i.image_name FROM product p, images i WHERE i.no = p.no ";
    $query.= "AND image_name like '%\_0%' AND p.type = :type ORDER BY {$sort_type} {$arg_order_type}";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":type",$arg_product_type, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    while($row = $stmt->fetch()){
      $product_result = array();

      $qeury ="SLEECT image_path FROM images WHERE no = :no";

      // array_push($product_result,$row['no']);
      // array_push($product_result,$row['product_name']);
      // array_push($product_result,$row['time']);
      // array_push($product_result,$row['price']);
      // array_push($product_result,$row['type']);
      // array_push($product_result,$row['discount']);
      // array_push($product_result,$row['point']);
      // array_push($product_result,$row['gender']);
      // array_push($product_result,$row['size']);
      // array_push($product_result,$row['color']);
      // array_push($product_result,$row['option']);
      // array_push($product_result,$row['stock']);
      // array_push($product_result,$row['VIEW']);
      //
      array_push($this->product_results,$row);

    }
    return $this->product_results;
  }

  function show_select_product_select($arg_no){
    $query = "SELECT * FROM product WHERE no = :no ";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":no",$arg_no, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result=$stmt->fetch();

    return $result;
  }

  function show_select_product_images($arg_no){
    $query = "SELECT * FROM images WHERE no = :no ";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":no",$arg_no, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result=$stmt->fetchAll();

    return $result;
  }


  function product_sell($arg_no,$arg_count){
    $query = "SELECT stock FROM product WHERE no = :no ";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":no",$arg_no, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result=$stmt->fetch();

    $result_stock = $result['stock']; //재고값을 가져옴

    $rest_stock = $result_stock - $arg_count; //arg_count 는 구매한개수

    $query = "UPDATE product SET stock = :stock WHERE no = :no ";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":stock",$rest_stock, PDO::PARAM_INT);
    $stmt->bindParam(":no",$arg_no, PDO::PARAM_INT);
    $stmt->execute();
  }


  function product_order_list_add($arg_id,$arg_product_name,$arg_price,$arg_count){
    $query = "INSERT INTO product_order_list(id,product_name,price,count) VALUES(:id,:product_name,:price,:count)";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":id",$arg_id, PDO::PARAM_STR);
    $stmt->bindParam(":product_name",$arg_product_name, PDO::PARAM_STR);
    $stmt->bindParam(":price",$arg_price, PDO::PARAM_INT);
    $stmt->bindParam(":count",$arg_count, PDO::PARAM_INT);
    $stmt->execute();
  }


// ==================================board===================================

  function board_insert($arg_title,$arg_writer,$arg_contents,$arg_files,$arg_view){

    $query = "INSERT INTO free_board(title,writer,contents,files,view) ";
    $query .= "VALUES(:title,:writer,:contents,:files,:view)";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":title",$arg_title, PDO::PARAM_STR);
    $stmt->bindParam(":writer",$arg_writer, PDO::PARAM_STR);
    $stmt->bindParam(":contents",$arg_contents, PDO::PARAM_STR);
    $stmt->bindParam(":files",$arg_files, PDO::PARAM_STR);
    $stmt->bindParam(":view",$arg_view, PDO::PARAM_INT);

    $stmt->execute();
  }


  function show_board($arg_page){


    $limit_start_page = ($arg_page*10);  //몇번 인덱스부터 가져올것인가?
    $limit_end_page = 10;  //게시물 몇개를 가져올것인가?


    // $query = "SELECT * FROM product WHERE type = :type ORDER BY {$sort_type} {$arg_order_type} ";
    $query = "SELECT * FROM free_board ORDER BY no DESC LIMIT :f_limit,:e_limit";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":f_limit",$limit_start_page, PDO::PARAM_INT);
    $stmt->bindParam(":e_limit",$limit_end_page, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    while($row = $stmt->fetch()){
      $board_result = array();

      $qeury ="SLEECT image_path FROM images WHERE no = :no";
      array_push($this->board_results,$row);

    }
    return $this->board_results;
  }

  function board_count(){
    $query = "SELECT count(*) as count FROM free_board";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetch();

  }

  function show_select_board($arg_no){
    $query = "SELECT * FROM free_board WHERE no = :no ";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":no",$arg_no, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result=$stmt->fetch();

    return $result;
  }




// ==================================member==================================

  function insert_member($argId, $argPass, $argMember_name, $argAddress, $argGender, $argPhone, $argEmail) {
    $query = "INSERT INTO member VALUES (:id, :pass, :member_name, :address, :gender, :phone, :email, :point, :grade)";
    $stmt = $this->pdo->prepare($query, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
    $stmt->execute(
        array(
          ":id"=>$argId,
          ":pass"=>$argPass,
          ":member_name"=>$argMember_name,
          ":address"=>$argAddress,
          ":gender"=>$argGender,
          ":phone"=>$argPhone,
          ":email"=>$argEmail,
          ":point"=> 0,
          ":grade"=>"common"
         )
    );
  }


  function select_member($argId) {

    $query = "SELECT * FROM member WHERE id = :id";
    $stmt = $this->pdo->prepare($query, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
    $stmt->execute(array(":id"=>$argId));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  function delete_member($argId) {
    $query = "DELETE FROM member WHERE id = :id";
    $stmt = $this->pdo->prepare($query, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
    $stmt->execute(array(":id"=>$argId));
  }

  function modify_member($argPass, $argMember_name, $argGender, $argAddress, $argPhone, $argEmail, $argId) {
    $query = "UPDATE member SET pass = :pass, member_name = :member_name, gender = :gender, address = :address, phone = :phone, email = :email WHERE id = :id";
    $stmt = $this->pdo->prepare($query, array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
    $stmt->execute(array(
       ":pass"=>$argPass,
        ":member_name"=>$argMember_name,
        ":gender"=>$argGender,
        ":address"=>$argAddress,
        ":phone"=>$argPhone,
        ":email"=>$argEmail,
        ":id"=>$argId
    ));
  }


  // ==================================mypage==================================

  function order_list($arg_id){
    $query = "SELECT * FROM product_order_list WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->bindParam(":id",$arg_id, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();
  }


}




 ?>
