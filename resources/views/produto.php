<!DOCTYPE html>
<!--suppress ALL -->
<html>
<head>
	<title>Produtos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/produto.css">
	<script src="js/produto.js"></script>
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
                    Nome: <input type="text" name="id">
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
                    Id: <input type="text" name="id">
                    nome: <input type="text" name="nome">
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