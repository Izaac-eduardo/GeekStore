-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/11/2025 às 14:58
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `geekstore`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `inserir_produtos_massivo` (IN `quantidade` INT)   BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= quantidade DO
        
        INSERT INTO produto (nome, categoria_id, descricao, imagem, valor, destaque, ativo)
        VALUES (
            CONCAT('Produto ', i),
            1,
            'Inserção automática',
            'sem_imagem.png',
            RAND() * 500,
            'N',
            'S'
        );
        
        SET i = i + 1;

    END WHILE;
END$$

--
-- Funções
--
CREATE DEFINER=`root`@`localhost` FUNCTION `verificar_estoque` (`produtoId` INT, `quantidadeSolicitada` INT) RETURNS VARCHAR(20) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
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

END$$

DELIMITER ;

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
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `email`, `senha`) VALUES
(2, 'Izaac Eduardo Soares', 'izaaceduardosoares24@gmail.com', '$2y$10$dvagwY6Syozel020Qi.mYOdyPbUZf.bKjIIoJKTPMYkc4Cfq9gELe'),
(4, 'eu', 'izaac.soares@grupointegrado.br', '$2y$10$HHusZh8eoIxzSzT2vG9PeOoh.WiNi2N7jqK.bOa7PfmwKnCC4id4K'),
(7, 'Murilo Pereira Macedo', 'mu@gmail.com', '$2y$10$KjiFEnMLEF/ThOdsmHixdOMRI2zy6Y9LtRWi7SEogZsCSsWAjCTHi');

-- --------------------------------------------------------

--
-- Estrutura para tabela `item`
--

CREATE TABLE `item` (
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `item`
--

INSERT INTO `item` (`pedido_id`, `produto_id`, `qtde`, `valor`) VALUES
(6, 15, 1, 50),
(7, 12, 1, 12),
(7, 14, 2, 20),
(8, 14, 1, 20),
(9, 10, 1, 12),
(10, 2, 4, 50),
(11, 10, 1, 12),
(12, 10, 3, 12),
(13, 10, 1, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `preference_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id`, `cliente_id`, `data`, `preference_id`) VALUES
(6, 2, '2025-11-21 23:14:47', 800256851),
(7, 2, '2025-11-21 23:18:43', 800256851),
(8, 2, '2025-11-22 17:04:52', 800256851),
(9, 2, '2025-11-22 17:35:22', 800256851),
(10, 2, '2025-11-23 10:23:50', 800256851),
(11, 2, '2025-11-23 10:24:59', 800256851),
(12, 2, '2025-11-23 10:40:56', 800256851),
(13, 2, '2025-11-23 10:49:03', 800256851);

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
  `destaque` enum('S','N') NOT NULL,
  `ativo` enum('S','N') NOT NULL,
  `estoque` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `categoria_id`, `descricao`, `imagem`, `valor`, `destaque`, `ativo`, `estoque`) VALUES
(1, 'Caneca Zelda', 8, '<p>Caneca oficial da série The Legend of Zelda: Esta caneca é feita de cerâmica de alta qualidade, com capacidade para 350 ml. Apresenta uma estampa vibrante do lendário personagem Link em uma das suas aventuras, capturando a essência da série. A caneca é resistente ao micro-ondas e à lava-louças, tornando-a prática para o uso diário. Ideal para fãs da franquia que desejam desfrutar de suas bebidas favoritas com estilo geek.</p>', 'cnzelda.jpg', 14.99, 'N', 'S', 5),
(2, 'Boneco do Batman', 4, '<p>Boneco do Batman: O boneco do Batman é feito em plástico resistente, possui aproximadamente 30 cm de altura e apresenta 11 pontos de articulação, o que permite várias poses para brincar ou colecionar. Os detalhes do traje são fiéis aos quadrinhos, com visual característico do herói, capa plástica e acabamento de alta qualidade. Indicado para crianças a partir de 3 anos e também recomendado para fãs e colecionadores que desejam representar o universo do personagem em sua coleção.</p>', 'b-batman.jpg', 50, 'S', 'S', 3),
(3, 'Camiseta Super Mario', 12, '<p>Camiseta oficial do Super Mario: Esta camiseta é feita de algodão 100% de alta qualidade, proporcionando conforto e durabilidade. Disponível em várias cores vibrantes, apresenta uma estampa frontal do icônico personagem Super Mario em ação, capturando a essência dos jogos clássicos. Disponível em diversos tamanhos para adultos e crianças, é perfeita para fãs do universo dos games que desejam expressar seu amor pelo personagem de forma estilosa e confortável.</p>', 'cmario.jpg', 25, 'N', 'S', 4),
(4, 'Boneco Homem-Aranha', 4, '<p>Boneco do Homem-Aranha: O boneco do Homem-Aranha é feito em plástico resistente, possui aproximadamente 30 cm de altura e apresenta 11 pontos de articulação, permitindo várias poses para brincar ou colecionar. Os detalhes do traje são fiéis aos quadrinhos, com acabamento de alta qualidade. Indicado para crianças a partir de 3 anos e também recomendado para fãs e colecionadores que desejam representar o universo do personagem em sua coleção.</p>', 'b-homemaranha.jpg', 45, 'N', 'S', 2),
(5, 'Caneca Mario Bros', 8, '<p>Caneca oficial do Mario Bros: Esta caneca é feita de cerâmica de alta qualidade, com capacidade para 350 ml. Apresenta uma estampa vibrante do icônico personagem Mario em uma das suas aventuras, capturando a essência dos jogos clássicos. A caneca é resistente ao micro-ondas e à lava-louças, tornando-a prática para o uso diário. Ideal para fãs da franquia que desejam desfrutar de suas bebidas favoritas com estilo geek.</p>', 'cnmario.jpg', 18, 'S', 'S', 8),
(6, 'Camiseta Zelda', 12, '<p>Camiseta oficial da série The Legend of Zelda: Esta camiseta é feita de algodão 100% de alta qualidade, proporcionando conforto e durabilidade. Disponível em várias cores vibrantes, apresenta uma estampa frontal do lendário personagem Link em ação, capturando a essência dos jogos clássicos. Disponível em diversos tamanhos para adultos e crianças, é perfeita para fãs do universo dos games que desejam expressar seu amor pelo personagem de forma estilosa e confortável.</p>', 'cmzelda.jpg', 30, 'S', 'S', 6),
(7, 'Boneco Super Mario', 4, '<p>Boneco do Super Mario: O boneco do Super Mario é feito em plástico resistente, possui aproximadamente 30 cm de altura e apresenta 11 pontos de articulação, permitindo várias poses para brincar ou colecionar. Os detalhes do traje são fiéis aos jogos, com acabamento de alta qualidade. Indicado para crianças a partir de 3 anos e também recomendado para fãs e colecionadores que desejam representar o universo do personagem em sua coleção.</p>', 'b-mario.jpg', 30, 'S', 'S', 2),
(8, 'Caneca Homem-Aranha', 8, '<p>Caneca oficial do Homem-Aranha: Esta caneca é feita de cerâmica de alta qualidade, com capacidade para 350 ml. Apresenta uma estampa vibrante do icônico personagem Homem-Aranha em uma das suas aventuras, capturando a essência dos quadrinhos. A caneca é resistente ao micro-ondas e à lava-louças, tornando-a prática para o uso diário. Ideal para fãs da franquia que desejam desfrutar de suas bebidas favoritas com estilo geek.</p>', 'cnspiderman.jpg', 15, 'N', 'S', 10),
(9, 'Camiseta Homem-Aranha', 12, '<p>Camiseta oficial do Homem-Aranha: Esta camiseta é feita de algodão 100% de alta qualidade, proporcionando conforto e durabilidade. Disponível em várias cores vibrantes, apresenta uma estampa frontal do icônico personagem Homem-Aranha em ação, capturando a essência dos quadrinhos. Disponível em diversos tamanhos para adultos e crianças, é perfeita para fãs do universo dos quadrinhos que desejam expressar seu amor pelo personagem de forma estilosa e confortável.</p>', 'cmspiderman.jpg', 25, 'N', 'S', 3),
(10, 'Mangá Naruto Vol.1', 16, '<p>Mangá Naruto Volume 1: Este é o primeiro volume da série de mangá Naruto, escrita e ilustrada por Masashi Kishimoto. A história segue as aventuras de Naruto Uzumaki, um jovem ninja com o sonho de se tornar o Hokage, o líder de sua vila. Este volume apresenta os primeiros capítulos da série, introduzindo personagens cativantes e batalhas emocionantes. Ideal para fãs de mangás e animes que desejam começar a coleção de Naruto.</p>', 'mnaruto.jpg', 12, 'N', 'S', 0),
(11, 'Mangá One Piece Vol.1', 16, '<p>Mangá One Piece Volume 1: Este é o primeiro volume da série de mangá One Piece, escrita e ilustrada por Eiichiro Oda. A história segue as aventuras de Monkey D. Luffy, um jovem pirata com o sonho de encontrar o tesouro lendário conhecido como One Piece e se tornar o Rei dos Piratas. Este volume apresenta os primeiros capítulos da série, introduzindo personagens cativantes e batalhas emocionantes. Ideal para fãs de mangás e animes que desejam começar a coleção de One Piece.</p>', 'monepiece.jpg', 12, 'S', 'S', 2),
(12, 'Mangá Attack on Titan Vol.1', 16, '<p>Mangá Attack on Titan Volume 1: Este é o primeiro volume da série de mangá Attack on Titan, escrita e ilustrada por Hajime Isayama. A história se passa em um mundo onde a humanidade vive cercada por enormes muralhas para se proteger dos Titãs, gigantes humanoides que devoram pessoas. Este volume apresenta os primeiros capítulos da série, introduzindo personagens cativantes e batalhas emocionantes. Ideal para fãs de mangás e animes que desejam começar a coleção de Attack on Titan.</p>', 'matackontitan.jpg', 12, 'N', 'S', 7),
(14, 'Caneca Lego', 8, '<p>Caneca personalizada de Lego: Caneca feita em cerâmica de alta qualidade, com capacidade média para 350 ml, ideal para café, chá ou outras bebidas. Apresenta estampa colorida e vibrante com tema Lego, incluindo blocos icônicos e personagens do universo Lego que despertam a criatividade e a nostalgia. Resistente ao micro-ondas e lava-louças, é perfeita para fãs de Lego que querem um produto prático, divertido e cheio de personalidade para o dia a dia.</p>', 'cnlego.jpg', 20, 'S', 'S', 0),
(15, 'Boneco Superman', 4, '<p>Boneco do Superman: Figura de ação com aproximadamente 30 cm de altura, feita em material plástico resistente. Possui múltiplos pontos de articulação nos braços, pernas e cabeça, permitindo criar poses dinâmicas e realistas, ideais para recriar cenas épicas do universo Superman. Com detalhes fiéis ao personagem clássico da DC Comics, esta peça é perfeita tanto para brincadeiras quanto para colecionadores e fãs do super-herói. Indicado para crianças a partir de 3 anos, é uma excelente opção de presente para amantes de quadrinhos e cultura geek.</p>', 'b-superman.jpg', 50, 'N', 'S', 4),
(16, 'Mangá One Punch Man', 16, '<p>Mangá One Punch Man: Acompanhe a história de Saitama, um herói aparentemente comum que derrota qualquer inimigo com um único soco, enfrentando o tédio de sua imensa força. Este mangá combina ação intensa, humor e críticas ao gênero de super-heróis, trazendo personagens carismáticos e batalhas épicas. Ideal para fãs de histórias eletrizantes e cheias de sátira, One Punch Man é um sucesso mundial que conquista leitores com sua originalidade e estilo visual impactante.</p>', 'monepunchman.jpg', 28, 'S', 'S', 2),
(17, 'Produto 1', 1, 'Inserção automática', 'sem_imagem.png', 38.04033951651336, 'N', 'S', 0),
(18, 'Produto 2', 1, 'Inserção automática', 'sem_imagem.png', 468.9859780194107, 'N', 'S', 0),
(19, 'Produto 3', 1, 'Inserção automática', 'sem_imagem.png', 230.80888691433603, 'N', 'S', 0),
(20, 'Produto 4', 1, 'Inserção automática', 'sem_imagem.png', 247.0865158802704, 'N', 'S', 0),
(21, 'Produto 5', 1, 'Inserção automática', 'sem_imagem.png', 43.005934025166496, 'N', 'S', 0),
(22, 'Produto 6', 1, 'Inserção automática', 'sem_imagem.png', 473.77013785184374, 'N', 'S', 0),
(23, 'Produto 7', 1, 'Inserção automática', 'sem_imagem.png', 239.83290255054172, 'N', 'S', 0),
(24, 'Produto 8', 1, 'Inserção automática', 'sem_imagem.png', 277.85411456399976, 'N', 'S', 0),
(25, 'Produto 9', 1, 'Inserção automática', 'sem_imagem.png', 169.7718805351964, 'N', 'S', 0),
(26, 'Produto 10', 1, 'Inserção automática', 'sem_imagem.png', 15.29707435080509, 'N', 'S', 0),
(27, 'Produto 11', 1, 'Inserção automática', 'sem_imagem.png', 67.16974551525874, 'N', 'S', 0),
(28, 'Produto 12', 1, 'Inserção automática', 'sem_imagem.png', 289.95751989070095, 'N', 'S', 0),
(29, 'Produto 13', 1, 'Inserção automática', 'sem_imagem.png', 248.27837827455102, 'N', 'S', 0),
(30, 'Produto 14', 1, 'Inserção automática', 'sem_imagem.png', 371.5193470674747, 'N', 'S', 0),
(31, 'Produto 15', 1, 'Inserção automática', 'sem_imagem.png', 112.761615880543, 'N', 'S', 0),
(32, 'Produto 16', 1, 'Inserção automática', 'sem_imagem.png', 449.2500535671134, 'N', 'S', 0),
(33, 'Produto 17', 1, 'Inserção automática', 'sem_imagem.png', 407.96543556076045, 'N', 'S', 0),
(34, 'Produto 18', 1, 'Inserção automática', 'sem_imagem.png', 192.07703246928475, 'N', 'S', 0),
(35, 'Produto 19', 1, 'Inserção automática', 'sem_imagem.png', 236.4888710309648, 'N', 'S', 0),
(36, 'Produto 20', 1, 'Inserção automática', 'sem_imagem.png', 106.21327311379208, 'N', 'S', 0),
(37, 'Produto 21', 1, 'Inserção automática', 'sem_imagem.png', 321.59976784288864, 'N', 'S', 0),
(38, 'Produto 22', 1, 'Inserção automática', 'sem_imagem.png', 289.3590352398893, 'N', 'S', 0),
(39, 'Produto 23', 1, 'Inserção automática', 'sem_imagem.png', 481.99588803760327, 'N', 'S', 0),
(40, 'Produto 24', 1, 'Inserção automática', 'sem_imagem.png', 41.90234983517076, 'N', 'S', 0),
(41, 'Produto 25', 1, 'Inserção automática', 'sem_imagem.png', 263.52410042986656, 'N', 'S', 0),
(42, 'Produto 26', 1, 'Inserção automática', 'sem_imagem.png', 191.913468010643, 'N', 'S', 0),
(43, 'Produto 27', 1, 'Inserção automática', 'sem_imagem.png', 168.99505413043784, 'N', 'S', 0),
(44, 'Produto 28', 1, 'Inserção automática', 'sem_imagem.png', 269.2348819870827, 'N', 'S', 0),
(45, 'Produto 29', 1, 'Inserção automática', 'sem_imagem.png', 339.1892629109223, 'N', 'S', 0),
(46, 'Produto 30', 1, 'Inserção automática', 'sem_imagem.png', 388.24168396018604, 'N', 'S', 0),
(47, 'Produto 31', 1, 'Inserção automática', 'sem_imagem.png', 423.64064643498574, 'N', 'S', 0),
(48, 'Produto 32', 1, 'Inserção automática', 'sem_imagem.png', 453.47819566119296, 'N', 'S', 0),
(49, 'Produto 33', 1, 'Inserção automática', 'sem_imagem.png', 496.4690543678301, 'N', 'S', 0),
(50, 'Produto 34', 1, 'Inserção automática', 'sem_imagem.png', 121.91070022239415, 'N', 'S', 0),
(51, 'Produto 35', 1, 'Inserção automática', 'sem_imagem.png', 120.14635337530295, 'N', 'S', 0),
(52, 'Produto 36', 1, 'Inserção automática', 'sem_imagem.png', 234.99968157615484, 'N', 'S', 0),
(53, 'Produto 37', 1, 'Inserção automática', 'sem_imagem.png', 314.55936312168774, 'N', 'S', 0),
(54, 'Produto 38', 1, 'Inserção automática', 'sem_imagem.png', 367.7977862467969, 'N', 'S', 0),
(55, 'Produto 39', 1, 'Inserção automática', 'sem_imagem.png', 395.3108572357435, 'N', 'S', 0),
(56, 'Produto 40', 1, 'Inserção automática', 'sem_imagem.png', 373.16094280514955, 'N', 'S', 0),
(57, 'Produto 41', 1, 'Inserção automática', 'sem_imagem.png', 179.8721576853396, 'N', 'S', 0),
(58, 'Produto 42', 1, 'Inserção automática', 'sem_imagem.png', 279.8779753780719, 'N', 'S', 0),
(59, 'Produto 43', 1, 'Inserção automática', 'sem_imagem.png', 359.773419201163, 'N', 'S', 0),
(60, 'Produto 44', 1, 'Inserção automática', 'sem_imagem.png', 459.23318523842204, 'N', 'S', 0),
(61, 'Produto 45', 1, 'Inserção automática', 'sem_imagem.png', 216.84568395544375, 'N', 'S', 0),
(62, 'Produto 46', 1, 'Inserção automática', 'sem_imagem.png', 206.52887942877493, 'N', 'S', 0),
(63, 'Produto 47', 1, 'Inserção automática', 'sem_imagem.png', 382.107360644366, 'N', 'S', 0),
(64, 'Produto 48', 1, 'Inserção automática', 'sem_imagem.png', 290.9501803023277, 'N', 'S', 0),
(65, 'Produto 49', 1, 'Inserção automática', 'sem_imagem.png', 308.42883494536284, 'N', 'S', 0),
(66, 'Produto 50', 1, 'Inserção automática', 'sem_imagem.png', 169.29364918665368, 'N', 'S', 0);

--
-- Acionadores `produto`
--
DELIMITER $$
CREATE TRIGGER `trg_auditar_preco` BEFORE UPDATE ON `produto` FOR EACH ROW BEGIN
    IF NEW.valor <> OLD.valor THEN
        INSERT INTO produto_auditoria (produto_id, valor_antigo, valor_novo)
        VALUES (OLD.id, OLD.valor, NEW.valor);
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_auditoria`
--

CREATE TABLE `produto_auditoria` (
  `id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `valor_antigo` double NOT NULL,
  `valor_novo` double NOT NULL,
  `data_alteracao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto_auditoria`
--

INSERT INTO `produto_auditoria` (`id`, `produto_id`, `valor_antigo`, `valor_novo`, `data_alteracao`) VALUES
(1, 2, 70, 50, '2025-11-20 19:15:35'),
(2, 7, 23, 30, '2025-11-23 13:47:54');

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
(1, 'izaac', 'izaac@gmail.com', '$2y$10$L1nbj0I0K4Rc2tt0/jEDuube0aVgHzU62fG7X0gLYTHPsAnkit0OG', '(44) 99999-1234', 'S'),
(2, 'luiz', 'luiz@gmail.com', '1234', '(44) 99999-9999', 'S'),
(3, 'Izaac Eduardo Soares', 'bill@gmail.com', '$2y$10$VKXJ7Mtdg56xSQ/cYyU45Oj1v9jWQ07Rp5tFOvIHSyGuvnxp7Sv/i', '(44) 99762-8795', 'S'),
(7, 'muliro', 'murilinho.pequeno@gmail.com', '$2y$10$sbL4blBKgkNrIkK9GpQja.NhoIGq2wmiz/xa1LQKQakCejnChamJm', '(22) 22222-2222', 'S');

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
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`pedido_id`,`produto_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_produto_categoria` (`categoria_id`),
  ADD KEY `idx_produto_nome` (`nome`),
  ADD KEY `idx_produto_ativo` (`ativo`),
  ADD KEY `idx_produto_destaque` (`destaque`);

--
-- Índices de tabela `produto_auditoria`
--
ALTER TABLE `produto_auditoria`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `produto_auditoria`
--
ALTER TABLE `produto_auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`id`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
