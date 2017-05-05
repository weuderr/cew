<!DOCTYPE html>
<!--suppress ALL -->
<html>
<head>
	<title>Estoque</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/produto.css">
	<script src="js/estoque.js"></script>
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
                </div>
			</div>
			<div id="criar" style="display: none;">
                <div class="geral">
                    Produto: <select></select></br>
                    Quantidade: <input type="text" name="quantidade"></br>
                    Custo: <input type="text" name="custo"></br>
                    <input type="submit" value="Salvar">
                </div>
            </div>
			<div id="exibir" style="display: none">
                <div class="geral">
                    Id: <input type="text" name="id">
                    <input type="submit" value="Buscar">
                </div>
            </div>
			<div id="atualizar" style="display: none">
                <div class="geral">
                    Id: <input type="text" name="id"></br>
                    Produto: <select></select></br>
                    Quantidade: <input type="text" name="quantidade"></br>
                    Custo: <input type="text" name="custo"></br>
                    <input type="submit" value="Salvar">
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