create database db_api;

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `status_ativo` varchar(1) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `profissao` varchar(100) DEFAULT NULL,
  `escolaridade` varchar(80) DEFAULT NULL,
  `descricao_perfil` text,
  `imagem_url` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nome`, `email`, `senha`, `cidade`, `estado`, `status_ativo`, `sexo`, `token`, `profissao`, `escolaridade`, `descricao_perfil`) VALUES
(1, 'Laciene Alves Melo', 'lacienealvesmelo@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'PA', '1', 'F', NULL, 'Analista de Sistemas', 'Ensino superior completo', NULL),
(2, 'Leonardo Nunes Gonçalves', 'leo.widgeon16@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'cametá', 'PA', '1', 'M', NULL, 'Engenheiro de computação', 'ensino superior completo', NULL),
(3, 'Fabricio de Souza Farias', 'fabriciosouzafarias@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'cametá', 'PA', '1', 'M', NULL, 'professor', 'ensino superior completo', NULL),
(4, 'Igor de Pinho', 'igorpinho@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Cametá', 'PA', '1', 'M', NULL, 'Gerente de Redes', 'Ensino superior incompleto', NULL),
(5, 'Odeth Melo', 'odeth@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'cametá', 'PA', NULL, 'F', NULL, NULL, NULL, NULL);
