<?php
// Recebendo os dados do formulário
$nome = $_POST['nome'];
$semanas = array($_POST['semana1'], $_POST['semana2'], $_POST['semana3'], $_POST['semana4']);
$total_mes = $_POST['total_mes'];
 
// Definindo os valores e percentuais
$salario_minimo = 1856.94;
$meta_semanal = 20000; // Meta semanal
$meta_mensal = 80000; // Meta mensal
 
// Inicializando as bonificações
$bonificacao_semanal = 0;
$bonificacao_mensal = 0;
 
// Calculando a bonificação sobre o valor das vendas de cada semana
foreach ($semanas as $venda_semanal) {
    if ($venda_semanal >= $meta_semanal) {
        $bonificacao_semanal += ($venda_semanal - $meta_semanal) * 0.05; // Bonificação sobre o excedente
        $bonificacao_semanal += $meta_semanal * 0.01; // Bonificação sobre a meta semanal
    }
}
 
// Verificando se todas as metas semanais foram atingidas
$metas_semanais_atingidas = count(array_filter($semanas, function ($venda_semanal) use ($meta_semanal) {
    return $venda_semanal >= $meta_semanal;
})) === 4; // Verifica se as 4 semanas atingiram a meta
 
// Verificando se a meta mensal foi atingida
if ($metas_semanais_atingidas && $total_mes > $meta_mensal) {
    $excedente_mensal = $total_mes - $meta_mensal;
    $bonificacao_mensal = $excedente_mensal * 0.1; // Bonificação sobre o excedente de meta mensal
}
 
// Calculando o salário final
$salario_final = $salario_minimo + $bonificacao_semanal + $bonificacao_mensal;
 
// Exibindo o resultado
echo "<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Resultado do Cálculo</title>
<link rel='stylesheet' href='styles.css'>
</head>
<body>
<div class='result'>
<h2>Resultado do Cálculo</h2>
<p>Nome do Funcionário: $nome</p>
<p>Salário Final: R$ " . number_format($salario_final, 2) . "</p>
</div>
</body>
</html>";
?>
