<?php

require_once __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../models/Pessoa.php';
require_once __DIR__ . '/../models/Empresa.php';
require_once __DIR__ . '/../models/Vaga.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Inscricao.php';

require_once __DIR__ . '/../utils/Security.php';
require_once __DIR__ . '/../utils/Session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handleCadastro($pdo);
}

function getRequestData()
{
    return $_POST;
}

function handleCadastro($pdo)
{
    Session::start();

    $dados = getRequestData();

    // Dados do formulário
    $email = filter_var($dados['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $senha = $dados['senha'] ?? '';
    $telefone = $dados['telefone'] ?? '';
    $cpf = $dados['cpf'];
    $cnpj = $dados['cnpj'];
    $tipo = $dados['tipo'] ?? '';

    // Redirect baseado no tipo
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $redirectCadastro = ($tipo === 'empresa')
            ? '../../public/views/cadastroEmpresa.php'
            : '../../public/views/cadastroPessoa.php';


        $errors = [];

        // Validações 
        if (!Security::validateEmail($email)) {
            $errors['email'] = "Email inválido!";
        }

        if (!Security::validateTelefone($telefone)) {
            $errors['telefone'] = "Telefone inválido!";
        }

        if (!Security::validatePassword($senha)) {
            $errors['senha'] = "A senha deve ter pelo menos 8 caracteres";
        }

        if ($tipo === 'empresa') {
            if (!Security::validateCNPJ($cnpj)) {
                $errors['cnpj'] = "CNPJ inválido!";
            }
        }

        if ($tipo === 'pessoa') {
            if (!Security::validateCPF($cpf)) {
                $errors['cpf'] = "CPF inválido!";
            }
        }

        if (empty($errors)) {
            try {
                $usuarioModel = new Usuario($pdo);
                $pessoaModel = new Pessoa($pdo);
                $empresaModel = new Empresa($pdo);

                // Verifica se email já existe
                if ($usuarioModel->buscarUsuarioPorEmail($email)) {
                    $errors['usuario'] = 'Email já cadastrado!';
                }

                if ($tipo === 'pessoa') {

                    if ($pessoaModel->buscarPorCPF($cpf)) {
                        $errors['cpf'] = 'CPF já cadastrado!';
                    }

                    if ($pessoaModel->buscarPorTelefone($telefone)) {
                        $errors['telefone'] = 'Telefone já cadastrado!';
                    }
                }

                if ($tipo === 'empresa') {

                    if ($empresaModel->buscarEmpresaPorCNPJ($cnpj)) {
                        $errors['cnpj'] = 'CNPJ já cadastrado!';
                    }

                    if ($empresaModel->buscarEmpresaPorTelefone($telefone)) {
                        $errors['telefone'] = 'Telefone já cadastrado!';
                    }
                }

                // Hash da senha
                $senhaHash = Security::hashPassword($senha);

                // Transação segura (banco empresa e pessoa)
                $pdo->beginTransaction();

                // Criar Usuário
                $userId = $usuarioModel->criarUsuario($email, $senhaHash, $tipo);

                // Criar dados específicos (Pessoa e Empresa)
                if ($tipo === 'pessoa') {
                    $dadosPessoa = [
                        'nome' => Security::sanitizeInput($dados['nome'] ?? ''),
                        'cpf' => Security::sanitizeInput($dados['cpf'] ?? ''),
                        'telefone' => Security::sanitizeInput($dados['telefone'] ?? ''),
                        'instituicao' => Security::sanitizeInput($dados['instituicao'] ?? ''),
                        'curso' => Security::sanitizeInput($dados['curso'] ?? '')
                    ];
                    $pessoaModel->criarPessoa($userId, $dadosPessoa);
                } elseif ($tipo === 'empresa') {
                    $dadosEmpresa = [
                        'nome' => Security::sanitizeInput($dados['nome'] ?? ''),
                        'cnpj' => Security::sanitizeInput($dados['cnpj'] ?? ''),
                        'telefone' => Security::sanitizeInput($dados['telefone'] ?? ''),
                        'cidade' => Security::sanitizeInput($dados['cidade'] ?? '')
                    ];
                    $empresaModel->createEmpresa($userId, $dadosEmpresa);
                }

                // Se der tudo certo, confirma tudo
                $pdo->commit();

                header("Location: ../../public/views/login.php");
                exit;
            } catch (PDOException $e) {
                error_log("Erro no cadastro " . $e->getMessage());

                // Se estiver em transaction, o rollBack volta se der alguma coisa errada
                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }

                error_log("Erro no login: " . $e->getMessage());
                $errors['sistema'] = "Erro no sistema. Volte mais tarde.";

                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;

                header("Location: $redirectCadastro");
                exit;
            }
        }
    }

    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;


    header("Location: $redirectCadastro");
    exit;
}
