<?php
    require_once('../config.php');

    switch ($_POST['acao']) {
        case 'pesquisar':
            
            $af = new AdminFuncionario();
            $af->Pesquisa($_POST['pesquisa']);
            
            if($af->getExecuteResult())
            {
                foreach($af->getExecuteResult() as $func)
                {
                    extract($func);
                    $DataNascimento = date('d/m/Y',strtotime($DataNascimento));
                    echo "
                    <tr>
                        <td>{$Nome}</td>
                        <td class='text-center'>$DataNascimento</td>
                        <td class='text-center'>$qtfilho</td>
                        <td class='text-right'>
                            <button type='button' class='bt bt-primary editar' data-id='{$CodFuncionario}'>Editar</button>
                            <button type='button' class='bt bt-danger delete' data-id='{$CodFuncionario}'>Excluir</button>
                        </td>
                    </tr>                    
                    ";
                }
            }
            else
            {
                echo '<tr>
                    <td colspan="4" style="text-align: center">'.$af->getExecuteMsg().'</td>
                </tr>';
            }
            break;

        case 'create':
            $arr['Nome'] = $_POST['nomeFuncionario'];
            $arr['DataNascimento'] = date('Y-m-d', strtotime(str_replace('/','-', $_POST['dataNascimentoFuncionario'])));
            $arr['Salario'] = str_replace(',','.',str_replace('.','', str_replace('R$ ','',$_POST['salarioFuncionario'])));
            $arr['Atividades'] = $_POST['atividadesFuncionario'];

            $af = new AdminFuncionario();
            $af->exeCreate($arr);
            
            if($af->getExecuteResult())
                echo $af->getExecuteResult();
            else
                echo $af->getExecuteMsg();
            break;

        case 'editar':
            $af = new AdminFuncionario();
            $af->exeReadFunc($_POST['cod']);

            if($af->getExecuteResult())
                print_r(json_encode($af->getExecuteResult()[0]));
            else
                print_r($af->getExecuteMsg());
            break;

        case 'update':
            $arr['Nome'] = $_POST['nomeFuncionario'];
            $arr['DataNascimento'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['dataNascimentoFuncionario'])));
            $arr['Salario'] = str_replace(',','.',str_replace('.','', str_replace('R$ ','',$_POST['salarioFuncionario'])));
            $arr['Atividades'] = $_POST['atividadesFuncionario'];
            $cod= $_POST['codfunc'];

            $af = new AdminFuncionario();
            $af->exeUpdate($arr, $cod);

            if($af->getExecuteResult())
                echo $af->getExecuteResult();
            else
                echo $af->getExecuteMsg()[0];
            break;

        case 'delete':
            $af = new AdminFuncionario();
            $af->exeDelete($_POST['cod']);

            if($af->getExecuteResult())
                echo 'ok';
            else
                echo $af->getExecuteMsg();
            break;

        case 'selfilhos':
            $af = new AdminFuncionario();
            $af->exeReadFilhos($_POST['cod']);

            if($af->getExecuteResult())
            {
                foreach($af->getExecuteResult() as $func)
                {
                    extract($func);
                    $DataNascimento = date('d/m/Y',strtotime($DataDeNascimento));
                    echo "
                    <tr>
                        <form action='' name='cadFilho' data-action='createFilho'>
                            <td>$Nome</td>
                            <td class='text-center'>$DataNascimento</td>
                            <td class='text-right'>
                                <button type='button' class='bt bt-primary editarfilho' data-id='{$CodFuncionarioFilho}'>Editar</button>
                                <button type='button' class='bt bt-danger excluirfilho' data-id='{$CodFuncionarioFilho}'>Excluir</button>
                            </td>                 
                        </tr>  
                    ";
                }
            }
            else
            {
                echo '<tr>
                    <td colspan="3" style="text-align: center">'.$af->getExecuteMsg().'</td>
                </tr>';
            }
            break;

        case 'createfilho':
            $arr['CodFuncionario'] = $_POST['codfunc'];
            $arr['Nome'] = $_POST['nomefilho'];
            $arr['DataDeNascimento'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['datanascimentofilho'])));

            $af = new AdminFuncionario();
            $af->exeCreateFilho($arr);

            if($af->getExecuteResult())
                echo 'ok';
            else
                echo $af->getExecuteMsg();
            break;

        case 'editarfilho':
            $af = new AdminFuncionario();
            $af->exeReadFilho($_POST['cod']);

            if($af->getExecuteResult())
                print_r(json_encode($af->getExecuteResult()[0]));
            else
                echo $af->getExecuteMsg();
            break;

        case 'updatefilho':
            $arr['Nome'] = $_POST['nomefilho'];
            $arr['DataDeNascimento'] = date('Y-m-d', strtotime(str_replace('/','-',$_POST['datanascimentofilho'])));
            $cod = $_POST['codfilho'];

            $af = new AdminFuncionario();
            $af->exeUpdateFilho($arr, $cod);

            if($af->getExecuteResult())
                echo 'ok';
            else
                echo $af->getExecuteMsg();
            break;
        
        case 'deletefilho':
            $af = new AdminFuncionario();
            $af->exeDeleteFilho($_POST['cod']);

            if($af->getExecuteResult())
                echo 'ok';
            else
                echo $af->getExecuteMsg();

            break;

        default:
            echo 'ERRO: Ação não reconhecida.';
            break;
    }