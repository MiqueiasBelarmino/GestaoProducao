<h2>Trabalho de Conclusão do Curso de Tecnologia em Análise e Desenvolvimento de Sistemas</h2>
<h3>Laravel - PHP - MySQL - AdminLTE</h3>
</br></br>
<div>
<p>
O Sistema de Gerenciamento para Produção de Uniformes tem por objetivo
o gerenciamento das vendas em lojas de uniformes, visando otimizar os processos
de controle de produção. O sistema contemplará gerenciamento de compras,
vendas e confecção de produtos.</p>
<p>
Na venda, o cliente pede os itens desejados, especificando os detalhes
e tamanhos de cada um dos produtos. A partir daí é gerado um orçamento contendo
o total de cada item e o total do orçamento. Por fim, são apresentadas as formas de
pagamento disponíveis para o cliente. O cliente faz a aprovação do orçamento e
escolhe a forma de pagamento. Uma vez que o pedido foi pago/negociado, este é
encaminhado para produção. A produção é gerida por setores e o pedido só tramita
para um próximo processo com a finalização do processo e/ou subprocesso atual.</p>
<p>
A compra de materiais para confecção do pedido só é realizada após a
aprovação do orçamento. Com base nas informações de cada produto o sistema
calcula quanto de material será necessário comprar. O pagamento dos fornecedores
será feito após o recebimento das matérias primas, conforme acordado no ato da
compra com cada fornecedor.</p>
<p>
Uma vez cadastrado o pedido, este segue primeiramente para os setores de
arte e corte. No setor de artes são redesenhados/vetorizados as estampas
solicitadas pelo cliente referente as logomarcas/bordados/apliques dos itens do
pedido. As artes, após criadas, são encaminhadas para a aprovação do cliente. Uma
vez aprovadas são passadas para o setor de serigrafia para serem reveladas.</p>
<p>
Paralelo a isso, são feitos os cortes referente ao pedido, uma vez que não
há requisito para cortar os materiais. O pedido apenas sairá do corte quando estiver
finalizado este processo para, só então, passar para o setor de costura.</p>
<p>O setor de costura possui alguns processos, podendo ser costurados bolsos,
barras, mangas, golas, acabamentos de mangas, etc. O pedido pode passar para a
serigrafia mesmo antes da costura estar totalmente concluída. Ao ser finalizado
algum processo da costura como, por exemplo, a costura das barras das mangas,
estas podem ser encaminhadas para a serigrafia.</p>
<p>Em cada processo na produção é gerido “quanto” do “que” foi feito, podendo
assim ser verificado quantos itens estão prontos, quantos faltam, e estimar o tempo,
assim será possível manter histórico da produção e verificação de todos os itens do
pedido individualmente.</p>
<p>Com o pedido finalizado, ou seja, todos os itens confeccionados e
personalizados, será feita a verificação de qualidade, na qual será observado se
todos os itens atendem as especificações do pedido e, se a personalização foi
realizada de maneira que as artes estejam visualmente corretas.</p>
<p>Para que o sistema funcione de maneira a atender o contexto descrito
anteriormente é necessário o gerenciamento de funcionários, fornecedores, clientes,
transportadoras, materiais e produtos.</p>
<p>No gerenciamento de funcionários, fornecedores, clientes deve conter no
sistema as informações básicas, tais como: nome, CPF/CNPJ, endereço, localidade,
dados bancários (opcional para clientes) e contato. Já em materiais deve conter
informações de nome, tipo, rendimento por unidade de medida, composição, custo,
entre outras informações que serão utilizadas para cálculos de materiais, custos e
rendimento por pedido.</p>
<p>O sistema, uma vez que contemplará todas as situações anteriormente
explicadas, permitirá consolidar as informações em relatórios de forma a permitir
verificar custo e rendimento de materiais por pedido, tempo de produção em padrões
de pedidos, lucratividade, entre outros.</p>
</div>
