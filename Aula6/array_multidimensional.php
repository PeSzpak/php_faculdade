<?php
$alunos = [
    [
        "nome"  => "Pedro",
        "idade" => 19,
        "curso" => "ADS SENAC ",
        "nota"  => 10.0
    ],
    [
        "nome"  => "Adm",
        "idade" => 21,
        "curso" => "ADS SENAC ",
        "nota"  => 8.5
    ],
    [
        "nome"  => "Chris",
        "idade" => 15,
        "curso" => "ADS SENAC ",
        "nota"  => 5.0
    ]
];


function calcularMedia(float $nota)
{
    if ($nota >= 6.5) {
        return $status = "APROVADO";
    } else {
        return $status = "REPROVADO";
    }
}
foreach ($alunos as $aluno) {
    echo "nome :" . $aluno["nome"] . PHP_EOL;
    echo "idade :" . $aluno["idade"] . PHP_EOL;
    echo "curso :" . $aluno["curso"] . PHP_EOL;
    echo "nota :" . $aluno["nota"] . PHP_EOL;
    echo "status :" . calcularMedia($aluno["nota"]) . PHP_EOL;
    echo "===================================" . PHP_EOL;
}
