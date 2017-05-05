<!DOCTYPE html>
<!--suppress ALL -->
<html>
<head>
	<title>Estoque</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/produto.css">
	<script src="js/venda.js"></script>
</head>
<body>
    <?php echo view('menu'); ?>
	<div id="corpo">
		<div id="link">
			<div class="listar" >Listar</div>
			<div class="criar">Criar</div>
			<div class="exibir">Exibir</div>
			<div class="atualizar">Atualizar</div>
			<div class="deletar">Deletar</div>
		</div>
		<div class='content'>
			<div id="listar" style="display: none">
                <div class="geral">
                    <table>
                        <tr class="tabela">
                            <td>Id</td>
                            <td>Vendedor</td>
                            <td>Estoque id</td>
                            <td>Desconto</td>
                        </tr>
                    </table>
                </div>
			</div>
			<div id="criar" style="display: none;">
                <div class="geral">
                    <table>
                        <tr id="titulos">
                            <td><div class='produtosNome'>Produto</div></td>
                            <td><div class='quatnidades'>Quantidade (MAX)</div></td>
                            <td><div class='valores'>Valor (CUSTO)</div></td>
                            <td><div class='totais'>Total</div></td>
                        </tr>
                        <tr class='dados' id='inputaveis0'>
                            <td><select class="produto0"></select></td>
                            <td><input type="text" name="quantidade0"></td>
                            <td><input type="text" name="valor0"></td>
                            <td style="background-color: darkgreen;"><div class='sub_total0' ></div></td>
                        </tr>
                        <tr calss='desconto'>
                            <td></td>
                            <td></td>
                            <td><div>Desconto</div></td>
                            <td><input type="text" name="desconto" value="0,00"></td>
                        </tr>
                        <tr calss='desconto'>
                            <td></td>
                            <td></td>
                            <td><div>Valor pago</div></td>
                            <td><input type="text" name="desconto" value="0,00"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td style="background-color: red;"><div class="total">0,00</div></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><div><input type="submit" name='adicionar' value="adicionar"></td>
                            <td><input type="submit" name='salvar' value="Salvar"></div></td>
                        </tr>
                    </table>
                    
                    
                </div>
            </div>
			<div id="exibir" style="display: none">
                <div class="geral">
                    Id: <input type="text" name="id">
                    <input type="submit" value="Buscar">
                    <table style="display: none">
                        <tr class="tabela">
                            <td>Id</td>
                            <td>Vendedor</td>
                            <td>Estoque id</td>
                            <td>Desconto</td>
                        </tr>
                    </table>
                </div>
            </div>
			<div id="atualizar" style="display: none">
                <div class="geral">
                    Id: <input type="text" name="id">
                    Produto: <select></select>
                    Quantidade: <input type="text" name="quantidade">
                    Custo: <input type="text" name="custo">
                    <input type="submit" value="add">
                </div>
            </div>
			<div id="deletar" style="display: none">
                <div class="geral">
                    Id: <input type="text" name="id">
                    <input type="submit" value="Deletar">
                </div>
            </div>
		</div>
	</div>
</body>
</html>