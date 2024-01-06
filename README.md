# Passo
  ## Criar banco de dados Mysql;
    * CREATE DATABASE `app` CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

  ## Estrutura das tabelas

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for fornecedores
-- ----------------------------
DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE `fornecedores`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fornecedores
-- ----------------------------
INSERT INTO `fornecedores` VALUES (1, NULL, NULL, NULL, 'Sarandi');
INSERT INTO `fornecedores` VALUES (2, NULL, NULL, NULL, 'Fruki');
INSERT INTO `fornecedores` VALUES (3, NULL, NULL, NULL, 'Nestle');
INSERT INTO `fornecedores` VALUES (4, NULL, NULL, NULL, 'Santa Clara');
INSERT INTO `fornecedores` VALUES (5, NULL, NULL, NULL, 'Laka');
INSERT INTO `fornecedores` VALUES (6, NULL, NULL, NULL, 'Pepsico');

-- ----------------------------
-- Table structure for fornecedores_has_produtos
-- ----------------------------
DROP TABLE IF EXISTS `fornecedores_has_produtos`;
CREATE TABLE `fornecedores_has_produtos`  (
  `produto_id` bigint UNSIGNED NOT NULL,
  `fornecedor_id` bigint UNSIGNED NOT NULL,
  INDEX `fornecedores_has_produtos_produto_id_foreign`(`produto_id`) USING BTREE,
  INDEX `fornecedores_has_produtos_fornecedor_id_foreign`(`fornecedor_id`) USING BTREE,
  CONSTRAINT `fornecedores_has_produtos_fornecedor_id_foreign` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedores` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fornecedores_has_produtos_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fornecedores_has_produtos
-- ----------------------------
INSERT INTO `fornecedores_has_produtos` VALUES (1, 1);
INSERT INTO `fornecedores_has_produtos` VALUES (1, 2);
INSERT INTO `fornecedores_has_produtos` VALUES (4, 3);
INSERT INTO `fornecedores_has_produtos` VALUES (5, 4);
INSERT INTO `fornecedores_has_produtos` VALUES (6, 5);
INSERT INTO `fornecedores_has_produtos` VALUES (7, 6);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_01_05_195659_create_produtos', 1);
INSERT INTO `migrations` VALUES (6, '2024_01_05_200255_create_fornecedores', 1);
INSERT INTO `migrations` VALUES (7, '2024_01_05_200326_create_fornecedores_has_produtos', 1);
INSERT INTO `migrations` VALUES (8, '2024_01_05_201025_create_vendas', 1);
INSERT INTO `migrations` VALUES (9, '2024_01_05_201253_create_vendas_has_produtos', 1);
INSERT INTO `migrations` VALUES (10, '2024_01_06_004803_alter_vendas', 2);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for produtos
-- ----------------------------
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `referencia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `produtos_referencia_unique`(`referencia`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of produtos
-- ----------------------------
INSERT INTO `produtos` VALUES (1, NULL, NULL, NULL, 'Prod A', 'proda', 150.00);
INSERT INTO `produtos` VALUES (4, NULL, NULL, NULL, 'Prod B', 'prodb', 50.00);
INSERT INTO `produtos` VALUES (5, NULL, NULL, NULL, 'Proc C', 'prodc', 15.00);
INSERT INTO `produtos` VALUES (6, NULL, NULL, NULL, 'Prod D', 'prodd', 35.00);
INSERT INTO `produtos` VALUES (7, NULL, NULL, NULL, 'Prod F', 'prodf', 85.00);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for vendas
-- ----------------------------
DROP TABLE IF EXISTS `vendas`;
CREATE TABLE `vendas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `data` date NOT NULL,
  `cep` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `complemento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vendas
-- ----------------------------
INSERT INTO `vendas` VALUES (2, '2024-01-06 00:50:43', '2024-01-06 00:50:43', NULL, '2024-01-06', '39403-247', 'MG', 'Montes Claros', 'Vargem Grande II', 'Rua Justino Fonseca', '30', NULL);
INSERT INTO `vendas` VALUES (3, '2024-01-06 00:53:17', '2024-01-06 01:25:11', '2024-01-06 01:25:11', '2024-01-06', '39401-820', 'MG', 'Montes Claros', 'Barcelona Park', 'Rua Aderaldino Fernandes da Silva', '690', 'bl 12 apt 202');
INSERT INTO `vendas` VALUES (4, '2024-01-06 00:54:58', '2024-01-06 01:22:01', '2024-01-06 01:22:01', '2024-01-06', '39401-820', 'MG', 'Montes Claros', 'Barcelona Park', 'Rua Aderaldino Fernandes da Silva', '690', 'bl 12 apt 202');
INSERT INTO `vendas` VALUES (5, '2024-01-06 01:17:30', '2024-01-06 01:21:54', '2024-01-06 01:21:54', '2024-01-06', '39401-820', 'MG', 'Montes Claros', 'Barcelona Park', 'Rua Aderaldino Fernandes da Silva', '690', NULL);
INSERT INTO `vendas` VALUES (6, '2024-01-06 01:25:24', '2024-01-06 01:25:24', NULL, '2024-01-06', '39403-247', 'MG', 'Montes Claros', 'Vargem Grande II', 'Rua Justino Fonseca', '30', NULL);
INSERT INTO `vendas` VALUES (8, '2024-01-06 01:42:41', '2024-01-06 01:48:04', '2024-01-06 01:48:04', '2024-01-06', '39403-247', 'MG', 'Montes Claros', 'Vargem Grande II', 'Rua Justino Fonseca', '30', NULL);
INSERT INTO `vendas` VALUES (9, '2024-01-06 01:48:18', '2024-01-06 02:14:44', '2024-01-06 02:14:44', '2024-01-06', '39403-247', 'MG', 'Montes Claros', 'Vargem Grande II', 'Rua Justino Fonseca', '30', NULL);
INSERT INTO `vendas` VALUES (10, '2024-01-06 02:14:59', '2024-01-06 02:14:59', NULL, '2024-01-06', '39403-247', 'MG', 'Montes Claros', 'Vargem Grande II', 'Rua Justino Fonseca', '30', NULL);

-- ----------------------------
-- Table structure for vendas_has_produtos
-- ----------------------------
DROP TABLE IF EXISTS `vendas_has_produtos`;
CREATE TABLE `vendas_has_produtos`  (
  `venda_id` bigint UNSIGNED NOT NULL,
  `produto_id` bigint UNSIGNED NOT NULL,
  `valor` decimal(10, 2) NOT NULL,
  INDEX `vendas_has_produtos_venda_id_foreign`(`venda_id`) USING BTREE,
  INDEX `vendas_has_produtos_produto_id_foreign`(`produto_id`) USING BTREE,
  CONSTRAINT `vendas_has_produtos_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `vendas_has_produtos_venda_id_foreign` FOREIGN KEY (`venda_id`) REFERENCES `vendas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vendas_has_produtos
-- ----------------------------
INSERT INTO `vendas_has_produtos` VALUES (2, 1, 150.00);
INSERT INTO `vendas_has_produtos` VALUES (2, 6, 35.00);
INSERT INTO `vendas_has_produtos` VALUES (6, 6, 35.00);
INSERT INTO `vendas_has_produtos` VALUES (10, 4, 50.00);
INSERT INTO `vendas_has_produtos` VALUES (10, 6, 35.00);
INSERT INTO `vendas_has_produtos` VALUES (10, 1, 150.00);

SET FOREIGN_KEY_CHECKS = 1;


# Sistema
## Modelo
* todos os arquivos estão na pasta app

* O sistema foi construido em laravel foi ciada uma tela que lista as vendas uma tela que cadastra vendas e uam que edita vendas criadas.

* Na tela de listar vendas é possivel exluir uam venda.

* No cadastro é necessario escolher um produto no campo produtos e adicionar com o botão o que ira popular a tabela com o produto, é possivel tambem remocer o produto da tabela caso quiera>

* Abaixo da tabela esta o endereço de entrega onde é necessario preencher todo o endereço para ser possivel salvar.

* A busca de produto foi estilizada com o plugin select2 e as mensagens de feedback foi utilizado o plugin sweetalert2

<hr>


# Teste prático para Programador Web.

O objetivo deste teste é conhecer suas habilidades em:

* PHP, MySQL ou PostgreSQL, HTML, CSS e JavaScript;
* Entendimento e análise dos requisitos;
* Modelagem de banco de dados;
* Integração com WebServices;

A aplicação pode ser feita em PHP puro ou você pode utilizar algum framework conhecido no mercado.
## Problema

### Sistema de Vendas

* O cliente quer registrar a venda de produtos com a data da venda e endereço de entrega;
* Deve ser possível buscar produtos pelo nome ou referência;
* Na medida que vai adicionando os produtos na tela de venda, o sistema deverá listar em uma tabela  como o exemplo abaixo, o nome, preço e nome do(s) fornecedor(es) dos produtos adicionados. Deve também atualizar o valor total da venda. Exemplo:

|  Nome  |  Preço  |  Fornecedor(es)  |
| ------ | ------- | -----------------|
| Prod A | 5,60    |  Sarandi, Fruki  |
| Prod B | 20,00   |  Nestle          |
| Prod C | 120,00  |  Santa Clara     |

**Total: R$ 145,60**


* Deve ter um campo de CEP do endereço de entrega. Ao preencher esse campo busque automaticamente a UF, nome da cidade, bairro e rua de entrega.
* Não pode salvar a venda sem informar o endereço completo de entrega;
* O cliente necessita ter o o histórico completo das vendas, com seus itens, valor total, data e endereço de entrega completo;

## Requisitos

* A única tela de cadastro que você precisa fazer é a de vendas, não precisa criar as telas de cadastro de produtos e fornecedores, somente suas tabelas no ER e banco de dados. Popule as tabelas diretamente no banco com INSERT's;
* Criar um Modelo ER;
* O cadastro de produtos deve conter nome, referência e preço.  Todos obrigatórios (lembrando que você não vai criar a tela de cadastro, mas deve tratar isso no banco de dados);
* O banco de dados deve tratar a questão de um produto ter vários fornecedores, você deve criar campos/tabelas para tal;
* O cadastro de fornecedores só precisa ter nome;
* O banco de dados não pode permitir 2 produtos com mesma referência;
* Usar AJAX para buscar produtos e JavaScript para atualizar a tabela de produtos da venda;
* Considere sempre quantidade 1 para cada item adicionado na tela de venda;
* Deve usar o webservice da ViaCEP para completar o endereço após preencher o campo CEP;
* Os preços dos produtos sofrem atualização semanal, isso não pode interferir no valor das vendas registradas e de seus produtos. Modele o banco de dados de tal forma a tratar essa questão;
* Faça fork desse projeto e edite este README explicando como devo fazer para criar as tabelas e testar a tela de venda;
* Todos os arquivos necessários para rodar o projeto devem estar no repositório do github;