<?php
session_start();
require '../config/infoBase.php';

usleep(50000);

/**
* DEFINE CALLBACK (LOGIN) E RECUPERA POST
* página reponsável por receber os dados enviados pelos formulários,
* tratar os dados, executar as ações necessárias e enviar uma resposta ao usuário
*
* @author Beto Noronha
*/

$jSON = null;
$CallBack = 'Login';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] = $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    $conn = new Connection();

    //ELIMINA CÓDIGOS
    $PostData = array_map('strip_tags', $PostData);

    //SELECIONA AÇÃO
    switch ($Case):
        /* VALIDA OS DADOS E LOGA-SE NO SISTEMA
        * case responsável por validar os dads inseridos pelo usuário, no fórmulário de login,
        * e caso esteja correto, cria-se uma sessão no servidor para o usuário e redireciona- para o painel
        */
        case 'login_submit':
            if (in_array('', $PostData)){
                $jSON['trigger'] = AjaxErro('Enter your email and password, please!', E_USER_NOTICE);
            }else{
                if($conn->getConn()){
                    $PostData['password'] = hash('sha512', $PostData['password']);
                    $sql = "SELECT * FROM tb_users WHERE email = '{$PostData['email']}' AND password = '{$PostData['password']}'";
                    $result = pg_query($conn->getConn(), $sql);
                    if(pg_num_rows($result) > 0){
                        $sql = "SELECT * FROM tb_users WHERE email = '{$PostData['email']}' AND status = 1 AND level >= 1";
                        $result = pg_query($conn->getConn(), $sql);
                        if(pg_num_rows($result) > 0){
                             $ArrayResult = pg_fetch_all($result);
                             $_SESSION['userLogin'] = $ArrayResult[0];
                             $jSON['trigger'] = AjaxErro("&#10004; Hello <b>{$ArrayResult[0]['name']},</b> Welcome!");
                             $jSON['redirect'] = 'dashboard.php?p=home';
                        }else{
                            $jSON['trigger'] = AjaxErro('&#10008; User is not active!', E_USER_ERROR);
                        }
                    }else{
                        $jSON['trigger'] = AjaxErro('&#10008; Email or password incorrect!', E_USER_ERROR);
                    }
                }else{
                    $jSON['trigger'] = AjaxErro('&#10008; Database is not connected!', E_USER_ERROR);
                }
            }
            break;
    endswitch;

    //RETORNA O CALLBACK
    if ($jSON):
        echo json_encode($jSON);
    else:
        $jSON['trigger'] = AjaxErro('<b>Desculpe.</b> Mas uma ação do sistema não respondeu corretamente. Ao persistir, contate o desenvolvedor!', E_USER_ERROR);
        echo json_encode($jSON);
    endif;
else:
    //ACESSO DIRETO
    die('<br><br><br><center><h1>Acesso Restrito!</h1></center>');
endif;
