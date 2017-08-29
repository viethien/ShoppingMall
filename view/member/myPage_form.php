
<?php
/**
 * Created by PhpStorm.
 * User: bon
 * Date: 2016-12-06
 * Time: 오전 9:11
 */

    session_start();
    require_once ('C:/xampp/htdocs/php/shopping_mall/model/DAO.php');
    $db = new Database();
    $db->connect();
    $row =$db->select_member($_SESSION['user_id']);

    $id = $row['id'];
    $pass = $row['pass'];
    $member_name = $row['member_name'];
    $address = $row['address'];
    $gender = $row['gender'];
    $phone = $row['phone'];
    $email = $row['email'];
    $point = $row['point'];



    require_once('C:/xampp/htdocs/php/shopping_mall/list_layout.php');


    require_once('../top.php');
    $page_layout = new MyPage_layout();
    $page_layout->draw_myPageLayout($member_name, $point);

    if(!isset($_GET['mode']) or $_GET['mode']  == "info") {
        $page_layout->draw_mode_modify($id, $member_name, $address, $phone, $email);
    } else if($_GET['mode'] == "delete") {
        $page_layout->draw_mode_delete();
    } else if($_GET['mode'] == "cart") {
        $page_layout->draw_mode_cart();
    }

    require_once('../bottom.php');

?>

<script>
    function delete_passConfirm_check() {

        if(!document.delete_form.pass.value) {
            alert("비밀번호를 입력해주세요");
            document.delete_form.pass.focus();

        } else if(!document.delete_form.pass_confirm.value) {
            alert("비밀번호 확인을 입력해주세요");
            document.delete_form.pass_confirm.focus();
        } else {
            if(document.delete_form.pass.value != document.delete_form.pass_confirm.value) {
                alert("비밀번호가 일치하지 않습니다");

            } else {
                document.delete_form.submit();
            }
        }
    }

    function modify_check_input() {
        //pass 체크
        if(!document.modify_form.pass.value) {
            alert("현재 비밀번호를 입력해주세요");
            document.modify_form.pass.focus();
            return;
        }

        //change_pass 체크
        if(!document.modify_form.change_pass.value) {
            alert("변경 비밀번호를 입력해주세요");
            document.modify_form.change_pass.focus();
            return;
        }

        //change_pass_confirm 체크
        if(!document.modify_form.change_pass_confirm.value) {
            alert("변경 비밀번호 확인을 입력해주세요");
            document.modify_form.change_pass_confirm.focus();
            return;
        }

        if(document.modify_form.change_pass.value != document.modify_form.change_pass_confirm.value) {
            alert("비밀번호가 일치하지 않습니다");
            document.modify_form.change_pass.focus();
            return;
        }

        //name 체크
        if(!document.modify_form.change_name.value) {
            alert("이름을 입력해주세요");
            document.modify_form.change_name.focus();
            return;
        }

        //gender 체크
        if(!document.modify_form.change_gender.value) {
            alert("성별을 체크해주세요");
            return;
        }

        //address 체크
        if(!document.modify_form.change_address.value) {
            alert("주소를 입력해주세요");
            document.modify_form.change_address.focus();
            return;
        }

        //phone 체크
        if(!document.modify_form.change_phone1.value || !document.modify_form.change_phone2.value || !document.modify_form.change_phone3.value) {
            alert("전화번호를 입력해주세요");

            if(!document.modify_form.change_phone1.value) {
                document.modify_form.change_phone1.focus();
            } else if(!document.modify_form.change_phone2.value) {
                document.modify_form.change_phone2.focus();
            } else if(!document.modify_form.change_phone3.value) {
                document.modify_form.change_phone3.focus();
            }
            return;
        }

        //email 체크
        if(!document.modify_form.change_email1.value) {
            alert("메일를 입력해주세요");
            document.modify_form.change_email1.focus();
            return;
        }

        //if에 걸리지 않을 시 확인
        document.modify_form.submit();
    }

    function modify_reset_value() {
        document.modify_form.pass.value = "";
        document.modify_form.change_pass.value = "";
        document.modify_form.change_pass_confirm.value = "";
        document.modify_form.change_name.value = "<?php echo $member_name?>";
        document.modify_form.change_address.value = "<?php echo $address?>";
        document.modify_form.change_phone1.value = "010";
        document.modify_form.change_phone2.value = "";
        document.modify_form.change_phone3.value = "";
        document.modify_form.change_email1.value = "";
    }

</script>
