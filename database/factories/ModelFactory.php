<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('1542'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Produto::class, function (Faker\Generator $faker) {
    $list =[
            'Arroz',
            'Achocolatado',
            'Açúcar',
            'Adoçante',
            'Atum',
            'Azeite',
            'Azeitona',
            'Batata palha',
            'Baunilha',
            'Bombom',
            'Café',
            'Caldo',
            'Catchup',
            'Cereal',
            'Chá',
            'Champignon',
            'Chocolate',
            'Chocolate granulado',
            'Coco ralado',
            'Creme de leite',
            'Farinha de mandioca',
            'Farinha de milho',
            'Farinha de rosca',
            'Queijo',
            'Presunto',
            'Pão',
            'Sabonete',
            'Creme dental',
            'Desodorante',
            'Macarrão',
            'Creme de leite',
            'Sabão em pó',
            'Detergente',
    ];
    return [
        'nome' => $faker->randomElement($list),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Estoque::class, function (Faker\Generator $faker) {

    $produto = factory(App\Produto::class)->create();

    return [
        'produto_id' => $produto->id,
        'quantidade' => $faker->randomNumber(3),
        'custo' => $faker->randomFloat(1,0,10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\VendaItem::class, function (Faker\Generator $faker) {

    $estoque = factory(App\Estoque::class)->create();
    $quantidade =$faker->randomNumber(1);
    $valor = $faker->randomFloat(2,0,100);
    $subTotal = ($valor*$quantidade);

    return [
        'estoque_id' => $estoque->id,
        'quantidade' => $quantidade,
        'valor' => $valor,
        'sub_total' => $subTotal,
        'troca' => $faker->randomElement([true,false]),
        'cancelada' => $faker->randomElement([true,false]),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Venda::class, function (Faker\Generator $faker) {

    $itemVenda = factory(App\VendaItem::class, 2)->create();
    // dump($itemVenda[0]['id'].','.$itemVenda[1]['id']);
    $createList = $itemVenda[0]['id'].','.$itemVenda[1]['id'];
    $desconto = $faker->randomFloat(1,0,1);
    $total = ($itemVenda[0]->sub_total+$itemVenda[1]->sub_total) - $desconto;

    return [
        'nome_vendedor' => $faker->name,
        'venda_item_id' => $createList,
        'desconto' => $faker->randomFloat(1,0,1),
        'cancelada' => $faker->randomElement([true,false]),
        //CRIAR UM SUB TOTAL
        'total' => $total,
    ];
});