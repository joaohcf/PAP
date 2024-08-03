--
-- Database: `dbgestor`
--
CREATE DATABASE IF NOT EXISTS dbGestor;
USE dbGestor;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Categorias`
--

CREATE TABLE `Categorias` (
  `IDCategoria` int(11) NOT NULL,
  `Categoria` varchar(30) NOT NULL
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Categorias` (`IDCategoria`, `Categoria`) VALUES
(2, 'Botas'),
(4, 'Calças'),
(1, 'Capacetes'),
(5, 'Casacos'),
(3, 'Luvas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `Clientes` (
  `IDCliente` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `NIF` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Clientes` (`IDCliente`, `Nome`, `NIF`, `Email`, `Password`, `CreatedAt`) VALUES
(2, 'João', '123456789', 'joaosantos@hotmail.com', '21232f297a57a5a743894a0e4a801fc3', '2019-04-15 19:52:41'),
(3, 'Diana', '123456', 'dianasilva@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2019-04-27 16:38:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `Empresa` (
  `ID` int(11) NOT NULL,
  `Empresa` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Morada` text NOT NULL,
  `Localidade` text NOT NULL,
  `Telemovel` varchar(15) NOT NULL,
  `SlideOne` varchar(50) NOT NULL DEFAULT '/',
  `SlideTwo` varchar(50) NOT NULL DEFAULT '/',
  `SlideThree` varchar(50) NOT NULL DEFAULT '/'
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Empresa` (`ID`, `Empresa`, `Email`, `Morada`, `Localidade`, `Telemovel`, `SlideOne`, `SlideTwo`, `SlideThree`) VALUES
(1, 'MotoStars - Acessórios e Equipamentos Motard', 'motostarspap@gmail.com', 'Rua Jacobina Moreira', 'Braga, Portugal', '252 333 777', '/', '/search?search=origine%20strada', '/category?id=3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomendas`
--

CREATE TABLE `Encomendas` (
  `IDEncomenda` int(11) NOT NULL,
  `IDCliente` int(11) NOT NULL,
  `IDFactura` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Morada` text NOT NULL,
  `CodPostal` varchar(15) NOT NULL,
  `TipoPagamento` varchar(50) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Pronta` tinyint(1) NOT NULL DEFAULT '0',
  `Enviada` tinyint(1) NOT NULL DEFAULT '0'
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Encomendas` (`IDEncomenda`, `IDCliente`, `IDFactura`, `Nome`, `Morada`, `CodPostal`, `TipoPagamento`, `Data`, `Pronta`, `Enviada`) VALUES
(4, 3, 6, 'João', '304, Porto', '4444-44', 'Cobrança', '2019-06-25 19:27:11', 1, 1),
(5, 4, 7, 'Diana', '324, Lisboa', '3324-213', 'Cobrança', '2020-05-11 21:15:44', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `facturas`
--

CREATE TABLE `Facturas` (
  `IDFactura` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `NIF` int(20) NOT NULL,
  `Morada` varchar(100) NOT NULL,
  `CodPostal` varchar(15) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Facturas` (`IDFactura`, `Nome`, `NIF`, `Morada`, `CodPostal`, `Data`) VALUES
(3, 'João', 123456, 'Rua Manuel José, nº530', '4550-354', '2019-06-10 00:46:04'),
(5, 'João', 123456, 'Rua Isabel II, nº50', '4000-312', '2019-06-10 13:35:26'),
(6, 'João', 123456, 'Rua de quem, eu nao sei', '4444-44', '2019-06-25 19:27:11'),
(7, 'Diana', 123, '324, lisboa', '3324-213', '2020-05-11 21:15:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `factura_produtos`
--

CREATE TABLE `Factura_Produtos` (
  `IDFactura` int(11) NOT NULL,
  `IDProduto` int(11) NOT NULL,
  `Price` decimal(20,2) NOT NULL,
  `Quantidade` int(11) NOT NULL
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Factura_Produtos` (`IDFactura`, `IDProduto`, `Price`, `Quantidade`) VALUES
(1, 1, '114.00', 1),
(1, 2, '249.00', 1),
(1, 3, '39.00', 1),
(1, 4, '39.00', 1),
(1, 5, '159.00', 1),
(2, 1, '114.00', 1),
(2, 2, '249.00', 1),
(2, 3, '39.00', 1),
(2, 4, '39.00', 1),
(2, 5, '159.00', 1),
(3, 2, '199.92', 1),
(3, 5, '159.99', 1),
(4, 4, '39.99', 1),
(5, 2, '199.92', 1),
(6, 2, '199.92', 1),
(7, 1, '45.60', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos`
--

CREATE TABLE `Favoritos` (
  `ID` int(11) NOT NULL,
  `IDProduto` int(11) NOT NULL,
  `IDCliente` int(11) NOT NULL
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Favoritos` (`ID`, `IDProduto`, `IDCliente`) VALUES
(5, 3, 1),
(10, 4, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE `Marcas` (
  `IDMarca` int(11) NOT NULL,
  `Marca` varchar(30) NOT NULL
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Marcas` (`IDMarca`, `Marca`) VALUES
(4, 'AlpineStars'),
(5, 'Fox Racing'),
(2, 'HJC'),
(1, 'LS2'),
(3, 'Origine');

-- --------------------------------------------------------

--
-- Estrutura da tabela `moradas`
--

CREATE TABLE `Moradas` (
  `IDMorada` int(11) NOT NULL,
  `IDCliente` int(11) NOT NULL,
  `Designacao` varchar(30) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Morada` text NOT NULL,
  `CodPostal` varchar(15) NOT NULL
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Moradas` (`IDMorada`, `IDCliente`, `Designacao`, `Nome`, `Morada`, `CodPostal`) VALUES
(4, 1, 'Casa do José', 'José', 'Rua Mastiff nº230', '4760-300'),
(5, 1, 'Sr. António', 'Roberto', 'Penico de Valverde nº300', '4760-400'),
(6, 1, 'Casa', 'Bruna', 'Rua da Castanha nº10', '4760-500'),
(9, 2, 'Casa', 'João', 'Rua da Maçã nº88', '3333-234'),
(10, 5, 'Zé dos Cães', 'Puta do Zé dos Cães', 'R. do Engenho 2, Ribeirão', '2222-222'),
(13, 3, 'Casa', 'João', 'Rua de quem, eu nao sei', '4444-44'),
(14, 4, 'YOYO', 'Lima', '324, lisboa', '3324-213');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset`
--

CREATE TABLE `Password_reset` (
  `IDReset` int(11) NOT NULL,
  `ResetEmail` varchar(50) NOT NULL,
  `ResetToken` longtext NOT NULL,
  `ResetExpires` text NOT NULL
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `Produtos` (
  `IDProduto` int(11) NOT NULL,
  `Referencia` varchar(30) DEFAULT NULL,
  `Produto` varchar(50) NOT NULL,
  `IDMarca` int(11) NOT NULL,
  `IDCategoria` int(11) NOT NULL,
  `Quantidade` int(10) NOT NULL,
  `Preco` decimal(20,2) NOT NULL,
  `Descricao` text NOT NULL,
  `DataRegisto` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Desconto` tinyint(3) DEFAULT NULL
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

INSERT INTO `Produtos` (`IDProduto`, `Referencia`, `Produto`, `IDMarca`, `IDCategoria`, `Quantidade`, `Preco`, `Descricao`, `DataRegisto`, `Desconto`) VALUES
(1, 'C1', 'Capacete Origine Strada Matt Black-Yellow', 3, 1, 25, '114.00', '<h2>Detalhes técnicos</h2>\r\n<p>Peso: 1520 gr +/- 50gr</p>\r\n\r\n<h2>Norma:</h2>\r\n<p>ECE22-05</p>\r\n\r\n<h2>Caracteristicas técnicas</h2>\r\n\r\n<p>External shell:<br>\r\nThermoplastic resin shell</p>\r\n\r\n<p>Inner Lining:<br>\r\nRemovable and washable Inner lining</p>', '2019-02-15 00:00:00', 60),
(2, 'C2', 'Capacete HJC i70', 2, 1, 8, '249.90', '<h2>Full Face Motorcycle helmet i70</h2>\r\nAdvanced Polycarbonate Shell: Lightweight, superior fit and comfort using CAD technology. Aerodynamic motorcycle helmet HJC i70 with large eye port for greater visibility.\r\n<br>\r\nVision Plus (+10mm) Wide Shield provides enhanced visibility.\r\nSun Visor with Wider-Vision : Better peripheral vision, helps to reduce eye strain and excellent sunlight blocking with Scratch-resistant\r\nPowerful Air-flow Ventilation and Exhuast: five lower vents and top vents. Airflow flushes heat and humidity up and out.\r\nMicro Buckle: Quick-release and adjustable.\r\nUltra-quick,simple and secure shield ratchet system.\r\nAnti-fog lens prepared shield, anti-fog lens included.', '2019-02-15 00:00:00', 20),
(3, 'L1', 'Luvas AlpineStars Engine Preto/Cinza', 4, 3, 0, '39.99', '<p>A luva de motor é uma luva multi-material híbrida que oferece altos níveis de conforto e proteção. Macia, leve e flexível, a luva tem painéis de malha para níveis ótimos de respirabilidade, enquanto a palma de couro de camurça sintética resistente significa que é altamente durável. Também é reconfortante, graças ao TPR estrategicamente posicionado nas juntas. Outra característica interessante é a impressão condutora na palma da mão e nos dedos, que permite que os mecânicos operem um tablet enquanto usam as luvas.</p>', '2019-04-21 23:00:00', NULL),
(4, 'L2', 'Luvas AlpineStars Engine Black/Yellow', 4, 3, 15, '39.99', '<p>A luva de motor é uma luva multi-material híbrida que oferece altos níveis de conforto e proteção. Macia, leve e flexível, a luva tem painéis de malha para níveis ótimos de respirabilidade, enquanto a palma de couro de camurça sintética resistente significa que é altamente durável. Também é reconfortante, graças ao TPR estrategicamente posicionado nas juntas. Outra característica interessante é a impressão condutora na palma da mão e nos dedos, que permite que os mecânicos operem um tablet enquanto usam as luvas.</p>', '2019-04-21 23:00:00', NULL),
(5, 'L3', 'Luvas AlpineStars TECH 1-Z Preto/Branco', 4, 3, 15, '159.99', '<p>A Tech 1-Z Glove apresenta uma gama de inovações de design e material, resultando em um chassi ergonomicamente evoluído que oferece uma redução significativa de peso e melhores níveis de controle, conforto e desempenho da cabine. Com base em décadas de experiência técnica do programa de corrida da Alpinestars, esta luva possui uma fibra de aramida inovadora resistente a chamas que garante segurança e sensação superiores.</p>', '2019-04-21 23:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `suporte`
--

CREATE TABLE `Suporte` (
  `IDSuporte` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Telemovel` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `TipoSuporte` varchar(50) NOT NULL,
  `Descricao` text NOT NULL,
  `Data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Respondido` tinyint(1) NOT NULL
) CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;

--
-- Indexes for table `categorias`
--
ALTER TABLE `Categorias`
  ADD PRIMARY KEY (`IDCategoria`),
  ADD UNIQUE KEY `Categoria` (`Categoria`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`IDCliente`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `Empresa`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `encomendas`
--
ALTER TABLE `Encomendas`
  ADD PRIMARY KEY (`IDEncomenda`),
  ADD KEY `Factura` (`IDFactura`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `Facturas`
  ADD PRIMARY KEY (`IDFactura`);

--
-- Indexes for table `factura_produtos`
--
ALTER TABLE `Factura_Produtos`
  ADD KEY `Factura` (`IDFactura`) USING BTREE,
  ADD KEY `Produto` (`IDProduto`);

--
-- Indexes for table `favoritos`
--
ALTER TABLE `Favoritos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Produto` (`IDProduto`),
  ADD KEY `Cliente` (`IDCliente`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `Marcas`
  ADD PRIMARY KEY (`IDMarca`),
  ADD UNIQUE KEY `Marca` (`Marca`);

--
-- Indexes for table `moradas`
--
ALTER TABLE `Moradas`
  ADD PRIMARY KEY (`IDMorada`),
  ADD KEY `Cliente` (`IDCliente`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `Password_reset`
  ADD PRIMARY KEY (`IDReset`),
  ADD UNIQUE KEY `ResetEmail` (`ResetEmail`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `Produtos`
  ADD PRIMARY KEY (`IDProduto`),
  ADD KEY `Marca` (`IDMarca`),
  ADD KEY `Categoria` (`IDCategoria`);

--
-- Indexes for table `suporte`
--
ALTER TABLE `Suporte`
  ADD PRIMARY KEY (`IDSuporte`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `Categorias`
  MODIFY `IDCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `Clientes`
  MODIFY `IDCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `Empresa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `encomendas`
--
ALTER TABLE `Encomendas`
  MODIFY `IDEncomenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `Facturas`
  MODIFY `IDFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favoritos`
--
ALTER TABLE `Favoritos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `Marcas`
  MODIFY `IDMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `moradas`
--
ALTER TABLE `Moradas`
  MODIFY `IDMorada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `Password_reset`
  MODIFY `IDReset` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `Produtos`
  MODIFY `IDProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suporte`
--
ALTER TABLE `Suporte`
  MODIFY `IDSuporte` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;