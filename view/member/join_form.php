<?php

    require_once('C:/xampp/htdocs/php/shopping_mall/list_layout.php');

    $join_layout = new Join_layout();
    $join_layout->draw_joinLayout();
    // require_once('../bottom.php');
?>

<!-- <link rel="stylesheet" href="./public/join.css"> -->
<link rel="stylesheet" href="/php/shopping_mall/public/join.css">

<script>
    function passConfirm_check() {

        if(!document.join_form.pass.value) {
            alert("비밀번호를 입력해주세요");
            document.join_form.pass.focus();

        } else if(!document.join_form.pass_confirm.value) {
            alert("비밀번호 확인을 입력해주세요");
            document.join_form.pass_confirm.focus();
        } else {
            if(document.join_form.pass.value != document.join_form.pass_confirm.value) {
                alert("비밀번호가 일치하지 않습니다");

            } else {
                alert("비밀번호가 일치합니다");
            }
        }


    }

    function check_input() {

        //id 체크
        if(!document.join_form.id.value) {
            alert("아이디를 입력해주세요");
            document.join_form.id.focus();
            return; //현재 if에 만족할 경우 바로 종료
        }

        //pass 체크
        if(!document.join_form.pass.value) {
            alert("비밀번호를 입력해주세요");
            document.join_form.pass.focus();
            return;
        }

        //pass_confirm 체크
        if(!document.join_form.pass_confirm.value) {
            alert("비밀번호 확인을 입력해주세요");
            document.join_form.pass_confirm.focus();
            return;
        }

        if(document.join_form.pass.value != document.join_form.pass_confirm.value) {
            alert("비밀번호가 일치하지 않습니다");
            document.join_form.pass.focus();
            return;
        }

        //name 체크
        if(!document.join_form.name.value) {
            alert("이름을 입력해주세요");
            document.join_form.name.focus();
            return;
        }

        //gender 체크
        if(!document.join_form.gender.value) {
            alert("성별을 체크해주세요");
            return;
        }

        //address 체크
        if(!document.join_form.address.value) {
            alert("주소를 입력해주세요");
            document.join_form.address.focus();
            return;
        }

        //phone 체크
        if(!document.join_form.phone2.value || !document.join_form.phone3.value) {
            alert("전화번호를 입력해주세요");

            if(!document.join_form.phone2.value) {
                document.join_form.phone2.focus();
            } else {
                document.join_form.phone3.focus();
            }
            return;
        }

        //email 체크
        if(!document.join_form.email1.value) {
            alert("메일를 입력해주세요");
            document.join_form.email1.focus();
            return;
        }

        //if에 걸리지 않을 시 확인
        document.join_form.submit();
    }


    function reset_value() {
        document.join_form.id.value = "";
        document.join_form.pass.value = "";
        document.join_form.pass_confirm.value = "";
        document.join_form.name.value = "";
        document.join_form.address.value = "";
        document.join_form.phone2.value = "";
        document.join_form.phone3.value = "";
        document.join_form.email1.value = "";

        window.close();
    }
</script>
