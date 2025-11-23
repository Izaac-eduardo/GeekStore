-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 04/08/2025 às 20:24
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `avancada`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `descricao`, `ativo`) VALUES
(4, 'Bonecos', 'S'),
(8, 'Canecas', 'S'),
(12, 'Camisetas', 'S'),
(16, 'Mangás', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `valor` double NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT 0,
  `destaque` enum('S','N') NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(2, 'Action Figure Batman', 4, '<p>Boneco do Batman: O boneco do Batman é feito em plástico resistente, possui aproximadamente 30 cm de altura e apresenta 11 pontos de articulação, o que permite várias poses para brincar ou colecionar. Os detalhes do traje são fiéis aos quadrinhos, com visual característico do herói, capa plástica e acabamento de alta qualidade. Indicado para crianças a partir de 3 anos e também recomendado para fãs e colecionadores que desejam representar o universo do personagem em sua coleção.</p>', 'b-batman.jpg', 6.0, 'S', 'S');

 INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(3, 'Camiseta Super Mario', 12, '<p>Camiseta oficial do Super Mario: Esta camiseta é feita de algodão 100% de alta qualidade, proporcionando conforto e durabilidade. Disponível em várias cores vibrantes, apresenta uma estampa frontal do icônico personagem Super Mario em ação, capturando a essência dos jogos clássicos. Disponível em diversos tamanhos para adultos e crianças, é perfeita para fãs do universo dos games que desejam expressar seu amor pelo personagem de forma estilosa e confortável.</p>', 'cmario.jpg', 25.0, 'N', 'S');

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(1, 'Caneca Zelda', 8, '<p>Caneca oficial da série The Legend of Zelda: Esta caneca é feita de cerâmica de alta qualidade, com capacidade para 350 ml. Apresenta uma estampa vibrante do lendário personagem Link em uma das suas aventuras, capturando a essência da série. A caneca é resistente ao micro-ondas e à lava-louças, tornando-a prática para o uso diário. Ideal para fãs da franquia que desejam desfrutar de suas bebidas favoritas com estilo geek.</p>', 'cnzelda.jpg', 14.99, 'S', 'S');   

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(4, 'Boneco Homem-Aranha', 4, '<p>Boneco do Homem-Aranha: O boneco do Homem-Aranha é feito em plástico resistente, possui aproximadamente 30 cm de altura e apresenta 11 pontos de articulação, permitindo várias poses para brincar ou colecionar. Os detalhes do traje são fiéis aos quadrinhos, com acabamento de alta qualidade. Indicado para crianças a partir de 3 anos e também recomendado para fãs e colecionadores que desejam representar o universo do personagem em sua coleção.</p>', 'b-homemaranha.jpg', 45.0, 'S', 'S');        

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(5, 'Caneca Mario Bros', 8, '<p>Caneca oficial do Mario Bros: Esta caneca é feita de cerâmica de alta qualidade, com capacidade para 350 ml. Apresenta uma estampa vibrante do icônico personagem Mario em uma das suas aventuras, capturando a essência dos jogos clássicos. A caneca é resistente ao micro-ondas e à lava-louças, tornando-a prática para o uso diário. Ideal para fãs da franquia que desejam desfrutar de suas bebidas favoritas com estilo geek.</p>', 'cnmario.jpg', 18.0, 'S', 'S');  

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(6, 'Camiseta Zelda', 12, '<p>Camiseta oficial da série The Legend of Zelda: Esta camiseta é feita de algodão 100% de alta qualidade, proporcionando conforto e durabilidade. Disponível em várias cores vibrantes, apresenta uma estampa frontal do lendário personagem Link em ação, capturando a essência dos jogos clássicos. Disponível em diversos tamanhos para adultos e crianças, é perfeita para fãs do universo dos games que desejam expressar seu amor pelo personagem de forma estilosa e confortável.</p>', 'cmzelda.jpg', 30.0, 'S', 'S'); 

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(7, 'Boneco Super Mario', 4, '<p>Boneco do Super Mario: O boneco do Super Mario é feito em plástico resistente, possui aproximadamente 30 cm de altura e apresenta 11 pontos de articulação, permitindo várias poses para brincar ou colecionar. Os detalhes do traje são fiéis aos jogos, com acabamento de alta qualidade. Indicado para crianças a partir de 3 anos e também recomendado para fãs e colecionadores que desejam representar o universo do personagem em sua coleção.</p>', 'b-mario.jpg', 23.0, 'S', 'S');  

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(8, 'Caneca Homem-Aranha', 8, '<p>Caneca oficial do Homem-Aranha: Esta caneca é feita de cerâmica de alta qualidade, com capacidade para 350 ml. Apresenta uma estampa vibrante do icônico personagem Homem-Aranha em uma das suas aventuras, capturando a essência dos quadrinhos. A caneca é resistente ao micro-ondas e à lava-louças, tornando-a prática para o uso diário. Ideal para fãs da franquia que desejam desfrutar de suas bebidas favoritas com estilo geek.</p>', 'cnspiderman.jpg', 15.0, 'S', 'S');

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(9, 'Camiseta Homem-Aranha', 12, '<p>Camiseta oficial do Homem-Aranha: Esta camiseta é feita de algodão 100% de alta qualidade, proporcionando conforto e durabilidade. Disponível em várias cores vibrantes, apresenta uma estampa frontal do icônico personagem Homem-Aranha em ação, capturando a essência dos quadrinhos. Disponível em diversos tamanhos para adultos e crianças, é perfeita para fãs do universo dos quadrinhos que desejam expressar seu amor pelo personagem de forma estilosa e confortável.</p>', 'cmspiderman.jpg', 25.0, 'S', 'S');

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(10, 'Mangá Naruto Vol.1', 16, '<p>Mangá Naruto Volume 1: Este é o primeiro volume da série de mangá Naruto, escrita e ilustrada por Masashi Kishimoto. A história segue as aventuras de Naruto Uzumaki, um jovem ninja com o sonho de se tornar o Hokage, o líder de sua vila. Este volume apresenta os primeiros capítulos da série, introduzindo personagens cativantes e batalhas emocionantes. Ideal para fãs de mangás e animes que desejam começar a coleção de Naruto.</p>', 'mnaruto.jpg', 12.0, 'S', 'S');

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(11, 'Mangá One Piece Vol.1', 16, '<p>Mangá One Piece Volume 1: Este é o primeiro volume da série de mangá One Piece, escrita e ilustrada por Eiichiro Oda. A história segue as aventuras de Monkey D. Luffy, um jovem pirata com o sonho de encontrar o tesouro lendário conhecido como One Piece e se tornar o Rei dos Piratas. Este volume apresenta os primeiros capítulos da série, introduzindo personagens cativantes e batalhas emocionantes. Ideal para fãs de mangás e animes que desejam começar a coleção de One Piece.</p>', 'monepiece.jpg', 12.0, 'S', 'S');

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(12, 'Mangá Attack on Titan Vol.1', 16, '<p>Mangá Attack on Titan Volume 1: Este é o primeiro volume da série de mangá Attack on Titan, escrita e ilustrada por Hajime Isayama. A história se passa em um mundo onde a humanidade vive cercada por enormes muralhas para se proteger dos Titãs, gigantes humanoides que devoram pessoas. Este volume apresenta os primeiros capítulos da série, introduzindo personagens cativantes e batalhas emocionantes. Ideal para fãs de mangás e animes que desejam começar a coleção de Attack on Titan.</p>', 'matackontitan.jpg', 12.0, 'S', 'S');



INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(14, 'Caneca Lego', 8, '<p>Caneca personalizada de Lego: Caneca feita em cerâmica de alta qualidade, com capacidade média para 350 ml, ideal para café, chá ou outras bebidas. Apresenta estampa colorida e vibrante com tema Lego, incluindo blocos icônicos e personagens do universo Lego que despertam a criatividade e a nostalgia. Resistente ao micro-ondas e lava-louças, é perfeita para fãs de Lego que querem um produto prático, divertido e cheio de personalidade para o dia a dia.</p>', 'cnlego.jpg', 20.0, 'S', 'S');



INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`) VALUES
(16, 'Mangá One Punch Man', 16, '<p>Mangá One Punch Man: Acompanhe a história de Saitama, um herói aparentemente comum que derrota qualquer inimigo com um único soco, enfrentando o tédio de sua imensa força. Este mangá combina ação intensa, humor e críticas ao gênero de super-heróis, trazendo personagens carismáticos e batalhas épicas. Ideal para fãs de histórias eletrizantes e cheias de sátira, One Punch Man é um sucesso mundial que conquista leitores com sua originalidade e estilo visual impactante.</p>', 'monepunchman.jpg', 28.0, 'S', 'S');


-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `ativo` enum('S','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `telefone`, `ativo`) VALUES
(1, 'izaac', 'izaac@gmail.com', '1234', '(44) 99999-1234', 'S'),
(2, 'luiz', 'luiz@gmail.com', '1234', '(44) 99999-9999', 'S'),
(3, 'Bill Gates', 'bill@gmail.com', '$2y$10$vlKXwI9l1H42YtnKDrph0uXpV8TrtCKCyWOurwoMibSt.GsRg05qK', '(44) 99999-1234', 'S');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria` (`descricao`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Parte do Lulu

ALTER TABLE categoria
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE produto
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE usuario
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  
  
  
  
  CREATE TABLE produto_auditoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    valor_antigo DOUBLE NOT NULL,
    valor_novo DOUBLE NOT NULL,
    data_alteracao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



DELIMITER $$

CREATE TRIGGER trg_auditar_preco
BEFORE UPDATE ON produto
FOR EACH ROW
BEGIN
    IF NEW.valor <> OLD.valor THEN
        INSERT INTO produto_auditoria (produto_id, valor_antigo, valor_novo)
        VALUES (OLD.id, OLD.valor, NEW.valor);
    END IF;
END $$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE inserir_produtos_massivo(IN quantidade INT)
BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= quantidade DO
        
        INSERT INTO produto (nome, categoria_id, descricao, imagem, valor, destaque, ativo)
        VALUES (
            CONCAT('Produto de demonstração para o Murilo ver nossas altas e requentadas habilidades', i),
            1,
            'Inserção automática',
            'sem_imagem.png',
            RAND() * 500,
            'N',
            'S'
        );
        
        SET i = i + 1;

    END WHILE;
END $$

DELIMITER ;


CALL inserir_produtos_massivo(50);




-- Índice para melhorar filtragem por categoria
CREATE INDEX idx_produto_categoria ON produto(categoria_id);

-- Índice para buscas por nome
CREATE INDEX idx_produto_nome ON produto(nome);

-- Índice para produtos ativos
CREATE INDEX idx_produto_ativo ON produto(ativo);

-- Índice para destaque
CREATE INDEX idx_produto_destaque ON produto(destaque);

-- Índice no email do usuário já existe (UNIQUE)


ALTER TABLE produto ADD estoque INT NOT NULL DEFAULT 0;


DELIMITER $$

CREATE FUNCTION verificar_estoque(produtoId INT, quantidadeSolicitada INT)
RETURNS VARCHAR(20)
DETERMINISTIC
BEGIN
    DECLARE quantidadeAtual INT;

    SELECT estoque INTO quantidadeAtual 
    FROM produto 
    WHERE id = produtoId;

    IF quantidadeAtual IS NULL THEN
        RETURN 'PRODUTO_INEXISTENTE';
    END IF;

    IF quantidadeAtual >= quantidadeSolicitada THEN
        RETURN 'DISPONIVEL';
    ELSE
        RETURN 'INDISPONIVEL';
    END IF;

END $$

DELIMITER ;


SELECT verificar_estoque(3, 5);

-- Tabelas para gerenciamento de clientes e pedidos
CREATE TABLE geekstore.cliente (id INT(100) NOT NULL AUTO_INCREMENT , nome VARCHAR(100) NOT NULL , email VARCHAR(100) NOT NULL , senha VARCHAR(100) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB;

CREATE TABLE `geekstore`.`pedido` (`id` INT NOT NULL AUTO_INCREMENT , `cliente_id` INT NOT NULL , `data` DATETIME NOT NULL , `preference_id` INT NOT NULL , PRIMARY KEY (`id`), INDEX (`cliente_id`)) ENGINE = InnoDB;


-- ajustando tipo de dado da coluna preference_id
ALTER TABLE `pedido` CHANGE `preference_id` `preference_id` INT(50) NOT NULL;

-- Adicionando chave estrangeira para relacionar pedidos a clientes
ALTER TABLE `pedido` ADD FOREIGN KEY (`cliente_id`) REFERENCES `cliente`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Tabela para itens do pedido
CREATE TABLE `geekstore`.`item` (`pedido_id` INT NOT NULL , `produto_id` INT NOT NULL , `qtde` INT NOT NULL , `valor` DOUBLE NOT NULL , PRIMARY KEY (`pedido_id`, `produto_id`)) ENGINE = InnoDB;


---- Adicionando chaves estrangeiras para relacionar itens a pedidos e produtos
ALTER TABLE `item` ADD FOREIGN KEY (`pedido_id`) REFERENCES `pedido`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `item` ADD FOREIGN KEY (`produto_id`) REFERENCES `produto`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;