CREATE DATABASE vb_tec0279_proj_academia2;
USE vb_tec0279_proj_academia2;

CREATE TABLE IF NOT EXISTS vb_usuarios(
id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
login VARCHAR(15) UNIQUE NOT NULL,
senha VARCHAR(15) NOT NULL,	
perfil VARCHAR (15),
status CHAR(1) DEFAULT 's'
);

CREATE TABLE IF NOT EXISTS funcionario (
id_funcionario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(45) NOT NULL,
cpf VARCHAR(11) UNIQUE,
telefone VARCHAR(9),
dt_admissao DATE,
id_usuario INT NOT NULL,
FOREIGN KEY(id_usuario)
REFERENCES vb_usuarios (id_usuario)
);


CREATE TABLE IF NOT EXISTS administrador (
id_administrador INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_funcionario INT NOT NULL,
FOREIGN KEY(id_funcionario)
REFERENCES funcionario (id_funcionario)
);

CREATE TABLE IF NOT EXISTS vb_professor (
id_professor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
titulacao VARCHAR(20),
id_funcionario INT NOT NULL,
FOREIGN KEY(id_funcionario)
REFERENCES funcionario (id_funcionario)
);

CREATE TABLE IF NOT EXISTS operador(
id_operador INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_funcionario INT NOT NULL,
FOREIGN KEY(id_funcionario)
REFERENCES funcionario (id_funcionario)
);

CREATE TABLE IF NOT EXISTS vb_modalidade(
id_modalidade INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(50) NOT NULL,
valor_mensal DECIMAL(10,2) NOT NULL
);

CREATE TABLE IF NOT EXISTS vb_dias (
id_dia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
dia VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS vb_turma(
id_turma INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
data_inicio DATE,
horario TIME NOT NULL,
id_dia INT NOT NULL,
FOREIGN KEY(id_dia)
REFERENCES vb_dias (id_dia),
id_professor INT NOT NULL,
FOREIGN KEY(id_professor)
REFERENCES vb_professor (id_professor),
id_modalidade INT NOT NULL,
FOREIGN KEY(id_modalidade)
REFERENCES vb_modalidade (id_modalidade)
);

CREATE TABLE IF NOT EXISTS vb_cidade(
id_cidade INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
cidade VARCHAR(45)
);

CREATE TABLE IF NOT EXISTS vb_aluno (
cod_matricula INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(45) NOT NULL,
cpf VARCHAR(19) UNIQUE NOT NULL,
email VARCHAR(70),
sexo VARCHAR(9) NOT NULL,
fone_fixo VARCHAR(15),
fone_celular VARCHAR(15),
dt_nascimento DATE ,
endereco VARCHAR (75),
numero INT NOT NULL,
bairro VARCHAR (25),
senha CHAR (32), 
ativo CHAR(1) DEFAULT 's',
id_cidade INT NOT NULL,
FOREIGN KEY(id_cidade)
REFERENCES vb_cidade (id_cidade),
id_turma INT NOT NULL,
FOREIGN KEY(id_turma)
REFERENCES vb_turma (id_turma)
) AUTO_INCREMENT = 15498620;
/*cod_matricula é a própria matrícula do aluno e só existe uma para cada um e id_matricula é criada para cada turma que ele se matricular*/

CREATE TABLE IF NOT EXISTS vb_matricula(
id_matricula INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
cod_matricula INT NOT NULL,
FOREIGN KEY (cod_matricula) 
REFERENCES vb_aluno (cod_matricula), 
id_turma INT NOT NULL,
FOREIGN KEY(id_turma)
REFERENCES vb_turma (id_turma)
);

CREATE TABLE IF NOT EXISTS avaliacao_funcional(
id_avaliacao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
data_avaliacao date NOT NULL,
peso DECIMAL(10,2),
altura DECIMAL(10,2),
peito DECIMAL(10,2),
cintura DECIMAL(10,2),
quadril DECIMAL(10,2),
bracoEsquerdo DECIMAL(10,2),
bracoDireito DECIMAL(10,2),
coxaEsquerda DECIMAL(10,2),
coxaDireita DECIMAL(10,2),
panturrilhaEsquerda DECIMAL(10,2),
panturrilhaDireita DECIMAL(10,2),
imc DECIMAL (10,2),
id_professor INT NOT NULL,
FOREIGN KEY(id_professor)
REFERENCES vb_professor (id_professor),
cod_matricula INT NOT NULL,
FOREIGN KEY(cod_matricula)
REFERENCES vb_aluno(cod_matricula)
);

CREATE TABLE IF NOT EXISTS exercicio(
id_exercicio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
exercicio VARCHAR (50) NOT NULL,
tipoExercicio VARCHAR(25)
);

CREATE TABLE IF NOT EXISTS ficha(
id_ficha INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
observacoes VARCHAR (500),
inicio_treino DATE,
fim_treino DATE,
id_professor INT NOT NULL,
FOREIGN KEY(id_professor)
REFERENCES vb_professor (id_professor),
cod_matricula INT NOT NULL,
FOREIGN KEY(cod_matricula)
REFERENCES vb_aluno(cod_matricula)
);

CREATE TABLE IF NOT EXISTS treino( /*tabela associativa entre exercicio e ficha*/
id_treino INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_ficha INT NOT NULL,
FOREIGN KEY(id_ficha)
REFERENCES ficha(id_ficha),
id_exercicio INT NOT NULL,
FOREIGN KEY(id_exercicio)
REFERENCES exercicio(id_exercicio),
serie INT NOT NULL,
repeticao INT NOT NULL,
carga DECIMAL (10,2) NOT NULL
);

CREATE TABLE IF NOT EXISTS graficomodalidade(
id_graficomodalidade INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nome varchar(255),
qtd_alunos varchar(255)
);


CREATE TABLE IF NOT EXISTS secao (
id_secao INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
dt_secao DATE,
qtd_serie INT,
repeticao INT NOT NULL,
carga DECIMAL (10,2) NOT NULL,
id_ficha INT NOT NULL,
id_exercicio INT NOT NULL,
FOREIGN KEY(id_ficha) REFERENCES ficha (id_ficha),
FOREIGN KEY(id_exercicio) REFERENCES exercicio (id_exercicio)
);



INSERT INTO exercicio (id_exercicio, exercicio,tipoExercicio)VALUES
(null,'PUXADA POLIA BARRA','DORSAIS'),                          
(null,'PUXADA POLIA BARRA FRENTE','DORSAIS'),                  
(null,'REMADA MÁQUINA','DORSAIS'),                             
(null,'PUXADA MÁQUINA','DORSAIS'),                             
(null,'BARRA FIXA NO GRAVITON','DORSAIS'),                     
(null,'SERRATIL (PULL DOWN)','DORSAIS'),                        
(null,'REMADA CURVADA','DORSAIS'),                             
(null,'DESENVOLVIMENTO MÁQUINA','DELTÓIDES'),                  
(null,'CRUCIFIXO INV. MÁQUINA','DELTÓIDES'),                   
(null,'ENCOLHIMENTO','DELTÓIDES'),                             
(null,'ELEVAÇÃO DIAGONAL','DELTÓIDES'),                        
(null,'ELEVAÇÃO LATERAL','DELTÓIDES'),                         
(null,'ELEVAÇÃO FRONTAL','DELTÓIDES'),                        
(null,'REMADA ALTA','DELTÓIDES'),                              
(null,'ROSCA SCOTT','BÍCEPS'),                                 
(null,'BÍCEPS MÁQUINA','BÍCEPS'),                              
(null,'ROSCA CONCENTRADA','BÍCEPS'),                           
(null,'ROSCA INVERSA','BÍCEPS'),                               
(null,'ROSCA DIRETA','BÍCEPS'),                                
(null,'ROSCA ALTERNADA','BÍCEPS'),                             
(null,'SUPINO LIVRE RETO','PEITORAIS'),                        
(null,'SUPINO LIVRE INCLINADO','PEITORAIS'),                   
(null,'CRUCIFIXO MÁQUINA','PEITORAIS'),                        
(null,'FLY/PECK DECK','PEITORAIS'),                            
(null,'CROSS OVER','PEITORAIS'),                               
(null,'PULLOVER','PEITORAIS'),                                 
(null,'FLEXÃO DE BRAÇOS','PEITORAIS'),                         
(null,'AGACHAMENTO SMITH','MEMBROS INFERIORES'),               
(null,'LEG PRESS 45º','MEMBROS INFERIORES'),                   
(null,'CADEIRA EXTENSORA','MEMBROS INFERIORES'),               
(null,'MESA FLEXORA','MEMBROS INFERIORES'),                    
(null,'CADEIRA FLEXORA','MEMBROS INFERIORES'),                 
(null,'CADEIRA ADUTORA','MEMBROS INFERIORES'),                 
(null,'CADEIRA ABDUTORA','MEMBROS INFERIORES'),                
(null,'GLÚTEOS MÁQUINA','MEMBROS INFERIORES'),                 
(null,'GÊMEOS SENTADO','MEMBROS INFERIORES'),                  
(null,'GÊMEOS MÁQUINA EM PÉ','MEMBROS INFERIORES'),            
(null,'AGACHAMENTO MÁQUINA','MEMBROS INFERIORES'),             
(null,'LEG PRESS','MEMBROS INFERIORES'),                       
(null,'AFUNDO','MEMBROS INFERIORES'),                          
(null,'AVANÇO','MEMBROS INFERIORES'),                          
(null,'STIFF','MEMBROS INFERIORES'),                           
(null,'EXTENSÃO DO QUADRIL MÁQUINA','MEMBROS INFERIORES'),     
(null,'TRÍCEPS POLIA','TRÍCEPS'),                              
(null,'TRÍCEPS PARALELA','TRÍCEPS'),                           
(null,'TRÍCEPS MÁQUINA','TRÍCEPS'),                            
(null,'TRÍCEPS TESTA','TRÍCEPS'),                              
(null,'TRÍCEPS FRANCÊS','TRÍCEPS'),                            
(null,'ABDOMINAL MÁQUINA','ABDÔMEN/LOMBAR'),                   
(null,'ABDOMINAL HAMMER','ABDÔMEN/LOMBAR'),                    
(null,'LOMBAR MÁQUINA','ABDÔMEN/LOMBAR'),                      
(null,'HIPERTENSÃO LOMBAR','ABDÔMEN/LOMBAR'),                  
(null,'ABDOMINAL (SUPRA)','ABDÔMEN/LOMBAR'),                   
(null,'ABDOMINAL (INFRA)','ABDÔMEN/LOMBAR'),                   
(null,'ABDOMINAL (LATERAL)','ABDÔMEN/LOMBAR'),                 
(null,'ESTEIRA ERGOMÉTRICA','CARDIOVASCULAR'),                 
(null,'BICICLETA ERGOMÉTRICA','CARDIOVASCULAR'),               
(null,'ELÍPTICO ERGOMÉTRICA','CARDIOVASCULAR');                


/*INSERT COMPLETO*/
INSERT INTO vb_usuarios(id_usuario, login, senha, perfil, status) VALUES 
(null,'rosane','abc123','professor','s'),(null,'junior','abc123','professor','s'),(null,'kelli','abc123','professor','s'),(null,'elton','abc123','professor','s'),
(null,'ruth','abc123','professor','s'),(null,'pedro','abc123','professor','s'),(null,'rogerio','abc123','professor','s'),(null,'natalia','abc123','professor','s'),
(null,'renata','abc123','professor','s'),(null,'rogegio','abc123','professor','s'),(null,'anacarolina','abc123','professor','s'),(null,'leonardo','abc123','professor','s'),
(null,'liziane','abc123','professor','s'),(null,'eduardo','abc123','professor','s'),(null,'adriano','professor','abc123','s'),(null,'diversos','default','professor','s'),
(null,'rejane','abc123','professor','s'),(null,'jorgeane','abc123','professor','s'),(null,'stefanie','abc123','professor','s'),
(null,'botelhov','abc123','administrador','s'),(null,'vieirad','abc123','administrador','s'),
(null,'gilvan','abc123','operador','s'),(null,'marlene','abc123','operador','s'),(null,'nilce','abc123','operador','s'),(null,'tania','abc123','operador','s');

/*INSERT COMPLETO*/
INSERT INTO funcionario(id_funcionario, nome, cpf, telefone, dt_admissao, id_usuario) VALUES 
(null,'ROSANE','03245879488','9945-7842','2014-04-25',1),
(null,'JÚNIOR','65478947841','3215-4587','2011-05-20',2),
(null,'KELLI','32548795847','9548-1235','1998-08-07',3),
(null,'ELTON','20154874695','9478-2548','2007-06-10',4),
(null,'RUTH','31652498201','3412-1548','2003-09-27',5),
(null,'PEDRO','34284844658','8157-4578','2001-09-11',6),
(null,'ROGÉRIO','23541258744','8475-8745','2011-01-20',7),
(null,'NATÁLIA','97845874562','8152-7270','2010-10-10',8),
(null,'RENATA','12301257485','3254-6598','2013-11-20',9),
(null,'ROGÉGIO','9857425420','9874-4512','2005-11-16',10),
(null,'ANA CAROLINA','63524196857','9887-4125','2006-12-24',11),
(null,'LEONARDO','32497568410','2191-4949','2008-01-29',12),
(null,'LIZIANE','32678458712','2197-4512','2007-03-02',13),
(null,'EDUARDO','42698569874','3325-9687','2016-03-12',14),
(null,'ADRIANO','30125879451','3685-4651','2015-10-21',15),
(null,'DIVERSOS','94765320149','3265-4875','2010-10-25',16),
(null,'REJANE','34978463415','9674-5241','2014-02-28',17),
(null,'JORGEANE','62548713250','9154-7852','2013-03-15',18),
(null,'STÉFANIE','64978548120','9985-7275','2012-05-12',19),
(null, 'VANESSA ALVES BOTELHO','03215469111','9902-1540','2012-05-19',20),
(null, 'DOUGLAS VIEIRA DA SILVA','16978752030','9878-4578','2004-08-04',21),
(null,'GILVAN MACIEL', '16958752036','9584-7845','1990-11-16',22),
(null,'MARLENE DA COSTA','69873658745','8574-8958','1997-08-07',23),
(null,'NILCE MARIA','45875452021','9878-4512','1999-01-01',24),
(null,'TANIA MARA','64978450254','8784-8547','2001-02-03',25);

/*insert completo*/
INSERT INTO vb_professor(id_professor,titulacao, id_funcionario)
VALUES
(null,'ESPECIALISTA',1),
(null,'ESPECIALISTA',2),
(null,'DOUTORA',3),
(null,'ESPECIALISTA',4),
(null,'ESPECIALISTA',5),
(null,'MESTRE',6),
(null,'ESPECIALISTA',7),
(null,'MESTRE',8),
(null,'MESTRE',9),
(null,'MESTRE',10),
(null,'ESPECIALISTA',11),
(null,'MESTRE',12),
(null,'ESPECIALISTA',13),
(null,'ESPECIALISTA',14),
(null,'DOUTOR',15),
(null,' ',16),
(null,'MESTRE',17),
(null,'ESPECIALISTA',18),
(null,'DOUTORA',19);

/*insert completo*/
INSERT INTO administrador (id_administrador,id_funcionario) VALUES 
(null,20),(null,21);

/*insert completo*/
INSERT INTO operador(id_operador,id_funcionario) VALUES 
(null,22),(null,23),(null,24),(null,25);

/*insert completo*/
INSERT INTO vb_modalidade (id_modalidade, nome,valor_mensal)
VALUES
(null,'ALONGAMENTO (15 anos acima)',57.00),(null,'BABY CLASS (4 a 7 anos)',62.00),(null,'BALLET (7 a 12 anos)',74.00),
(null,'BOXE CHINÊS (13 anos acima)',120.00),(null,'DANÇA CIGANA (15 anos acima)',115.00),(null,'FUTSAL (6 a 14 anos)',69.00),
(null,'GINÁSTICA LOCALIZADA (15 anos acima)',48.00),(null,'HIDROGINÁSTICA (15 anos acima)',60.00),(null,'JAZZ (13 anos acima)',80.00),
(null,'JAZZ (7 a 12 anos)',80.00),(null,'JUDÔ (4 a 13 anos)',95.00),(null,'JUMP (15 anos acima)',80.00),
(null,'KRAV MAGÁ (13 anos acima)',47.00),(null,'MUSCULAÇÃO (15 anos acima)',55.00),(null,'NATAÇÃO ADAPTAÇÃO I (4 a 5 anos)',49.90),
(null,'NATAÇÃO ADAPTAÇÃO II (6 a 8 anos)',65.00),(null,'NATAÇÃO AVANÇADO ADULTO (15 anos acima)',67.00),
(null,'NATAÇÃO INICIAÇÃO ADULTO (15 anos acima)',61.00),(null,'NATAÇÃO INICIAÇÃO INFANTIL (9 a 14 anos)',60.00),
(null,'NATAÇÃO INTERMEDIÁRIO ADULTO (15 anos acima)',55.50),(null,'NATAÇÃO INTERMEDIÁRIO INFANTIL (9 a 14 anos)',63.00),
(null,'NATAÇÃO PARA BEBÊ I (de 1 ano a 1 ano e 11 meses)',65.00),(null,'NATAÇÃO PARA BEBÊ II (de 2 a 3 anos)',78.00),
(null,'NATAÇÃO RAIA LIVRE ADULTO (15 anos acima)',61.00),(null,'PILATES SOLO (15 anos acima)',125.00),
(null,'PSICOMOTRICIDADE (1 a 3 anos)',49.90),(null,'TREINAMENTO FUNCIONAL (15 anos acima)',75.00)
;

/*insert completo*/
INSERT INTO vb_dias(id_dia, dia)
VALUES 
(NULL,'2ª 4ª 6ª'),(NULL,'3ª 5ª'),(NULL,'4ª'),(NULL,'SÁBADO'),(NULL,'2ª a 6ª'),(NULL,'4ª 6ª'),(NULL,'6ª');

INSERT INTO vb_turma(id_turma, data_inicio, horario, id_dia, id_professor, id_modalidade)
VALUES
(null,'2010-10-25','08:00:00',1,1,1),(null,'2010-10-25','17:00:00',2,2,1),(null,'2010-10-25','15:00:00',1,3,2),
(null,'2010-10-25','14:00:00',1,3,3),(null,'2010-10-25','10:00:00',2,3,3),(null,'2010-10-25','06:00:00',1,4,4),
(null,'2010-10-25','11:00:00',3,5,5),(null,'2010-10-25','16:00:00',1,6,6),(null,'2010-10-25','10:00:00',2,7,6),
(null,'2010-10-25','15:00:00',2,6,6),(null,'2010-10-25','07:00:00',1,1,7),(null,'2010-10-25','12:10:00',1,1,7),
(null,'2010-10-25','18:10:00',1,8,7),(null,'2010-10-25','19:10:00',2,8,7),(null,'2010-10-25','07:00:00',1,9,8),
(null,'2010-10-25','08:00:00',1,10,8),(null,'2010-10-25','09:00:00',1,10,8),(null,'2010-10-25','16:00:00',1,11,8),
(null,'2010-10-25','17:10:00',1,12,8),(null,'2010-10-25','19:10:00',1,13,8),(null,'2010-10-25','09:00:00',2,1,8),
(null,'2010-10-25','10:00:00',2,1,8),(null,'2010-10-25','12:10:00',2,11,8),(null,'2010-10-25','16:00:00',2,11,8),
(null,'2010-10-25','17:10:00',2,12,8),(null,'2010-10-25','11:00:00',2,3,9),(null,'2010-10-25','16:00:00',1,3,10),
(null,'2010-10-25','09:00:00',2,14,11),(null,'2010-10-25','14:00:00',2,14,11),(null,'2010-10-25','19:10:00',1,8,12),
(null,'2010-10-25','12:10:00',2,1,12),(null,'2010-10-25','08:10:00',4,15,13),(null,'2010-10-25','10:00:00',4,15,13),
(null,'2010-10-25','06:00:00',5,16,14),(null,'2010-10-25','10:00:00',1,9,15),(null,'2010-10-25','14:00:00',6,17,15),
(null,'2010-10-25','09:00:00',2,18,15),(null,'2010-10-25','16:00:00',2,8,15),(null,'2010-10-25','09:00:00',1,9,16),
(null,'2010-10-25','15:00:00',6,17,16),(null,'2010-10-25','10:00:00',2,18,16),(null,'2010-10-25','14:00:00',2,8,16),
(null,'2010-10-25','08:00:00',2,1,17),(null,'2010-10-25','19:10:00',2,11,17),(null,'2010-10-25','06:00:00',1,18,18),
(null,'2010-10-25','07:00:00',1,10,18),(null,'2010-10-25','08:00:00',1,9,18),(null,'2010-10-25','11:10:00',1,9,18),
(null,'2010-10-25','17:10:00',1,11,18),(null,'2010-10-25','18:10:00',1,11,18),(null,'2010-10-25','19:10:00',1,11,18),
(null,'2010-10-25','12:10:00',6,19,18),(null,'2010-10-25','06:00:00',2,18,18),(null,'2010-10-25','07:00:00',2,18,18),
(null,'2010-10-25','08:00:00',2,18,18),(null,'2010-10-25','11:10:00',2,1,18),(null,'2010-10-25','12:10:00',2,8,18),
(null,'2010-10-25','13:00:00',2,11,18),(null,'2010-10-25','17:10:00',2,11,18),(null,'2010-10-25','18:10:00',2,17,18),
(null,'2010-10-25','19:10:00',2,17,18),(null,'2010-10-25','14:00:00',6,11,19),(null,'2010-10-25','11:10:00',2,18,19),
(null,'2010-10-25','15:00:00',2,17,19),(null,'2010-10-25','11:10:00',1,10,20),(null,'2010-10-25','12:10:00',1,17,20),
(null,'2010-10-25','18:10:00',1,2,20),(null,'2010-10-25','07:00:00',2,1,20),(null,'2010-10-25','13:10:00',2,8,20),
(null,'2010-10-25','18:10:00',2,11,20),(null,'2010-10-25','10:00:00',1,10,21),(null,'2010-10-25','15:00:00',6,11,21),
(null,'2010-10-25','14:00:00',2,11,21),(null,'2010-10-25','16:00:00',1,8,22),(null,'2010-10-25','15:00:00',2,8,23),
(null,'2010-10-25','13:00:00',1,12,24),(null,'2010-10-25','10:10:00',1,1,25),(null,'2010-10-25','11:10:00',1,1,25),
(null,'2010-10-25','17:00:00',1,8,25),(null,'2010-10-25','20:10:00',1,13,25),(null,'2010-10-25','07:00:00',2,7,25),
(null,'2010-10-25','08:00:00',2,7,25),(null,'2010-10-25','16:00:00',2,13,25),(null,'2010-10-25','18:10:00',2,8,25),
(null,'2010-10-25','14:30:00',7,8,26),(null,'2010-10-25','09:00:00',1,1,27),(null,'2010-10-25','20:10:00',2,12,27);

INSERT INTO vb_cidade (id_cidade, cidade) VALUES
(null,'Plano Piloto'),(null,'Gama'),(null,'Taguatinga'),(null,'Brazlândia'),(null,'Sobradinho'),(null,'Planaltina'),(null,'Paranoá'),
(null,'Núcleo Bandeirante'),(null,'Ceilândia'),(null,'Guará'),(null,'Cruzeiro'),(null,'Samambaia'),(null,'Santa Maria'),(null,'São Sebastião'),
(null,'Recanto das Emas'),(null,'Lago Sul'),(null,'Riacho Fundo'),(null,'Lago Norte'),(null,'Candangolândia'),(null,'Águas Claras'),
(null,'Riacho Fundo II'),(null,'Sudoeste/Octogonal'),(null,'Varjão'),(null,'Park Way'),(null,'SCIA'),(null,'Sobradinho II'),
(null,'Jardim Botânico'),(null,'Itapoã'),(null,'SIA'),(null,'Vicente Pires'),(null,'Fercal');

/*INSERT INTO avaliacao_funcional(id_avaliacao, peso, altura, peito, cintura, quadril, bracoEsquerdo, bracoDireito, coxaEsquerda,
coxaDireita, panturrilhaEsquerda, panturrilhaDireita, id_professor,cod_matricula) VALUES 
(NULL, 75,1.70) ,(NULL, 85,1.75), (NULL, 101,1.87),(NULL, 65, 1.73),(NULL, 69, 1.60),(NULL, 70,1.61),(NULL, 71,1.62),(NULL, 72,1.63),(NULL, 73,1.64),
(NULL, 74,1.65),(NULL, 76,1.67),(NULL, 77,1.68),(NULL, 78,1.69),(NULL, 65,1.70),(NULL, 66,1.71),(NULL, ),(NULL, 105,1.75, ),
(NULL, 65,1.72, ),(NULL, 78,1.80,),(NULL, 79,1.81)(NULL, 89,1.80,),(NULL, 61,1.65,),(NULL, 90,1.75,),(NULL, 92,1.78,),
(NULL, 67,1.73, ),(NULL, 68,1.80,),(NULL, 65,1.60,)(NULL,80,1.82),(NULL, 89,1.60,),(NULL, 91,1.76,),(NULL, 102,1.80,),
(NULL, 85,1.70,),(NULL, 84,1.85,),(NULL, 64,1.62,)(NULL, 94,1.80,),(NULL, 60,1.70,),(NULL, 65,1.75,),(NULL, 65,1.68,),
(NULL,62,1.66, ),(NULL, 63,1.63,),(NULL, 83,1.85,)(NULL, 95,1.81,),(NULL, 69,1.70,),(NULL, 55,1.50,),(NULL, 97,1.56,),
(NULL, 81,1.85, ),(NULL, 82, 1.83, ),(NULL, 75,1.66)(NULL, 89,1.71,),(NULL, 93,1.79, )(NULL, 67,1.80,),(NULL, 101,1.90,),(NULL, 98,1.85,); */         
       

INSERT INTO vb_aluno (cod_matricula, nome, senha, cpf, email, sexo, fone_fixo, fone_celular,  dt_nascimento, 
endereco, numero, bairro, id_cidade, id_turma)
VALUES

(null,'Maria das Graças Menezes', 'abc123', '05874945874','mariag@gmail.com', 'feminino','3269-7845','8265-7894','1964-12-20','Quadra 203 conjunto 16',7,'Centro', 15, 15
),

(null,'João Guerra Messias Magalhães', 'abc123','98765487945','joaogmm@gmail.com','masculino','3569-8745','9985-7458','1968-04-13','Avenida 1º de Março',28,
'Taubaté', 15, 47),

(null,'Tenório Antônio de Jesus Carvalho', 'abc123','54689589745','tenorio@hotmail.com','masculino','3265-7481','8425-9000','1987-04-21',
'R JOSE RODRIGUES PEDROS',286, 'CENTRO', 15,68),

(null,'Leandro Freitas de Oliveira', 'abc123','36587452120','leandrocorretor@bol.com.br','masculino','3408-1414','9933-4567','1981-05-25', 
'RUA SAO PAULO',939,'CENTRO',15,22),

(null,'Alexandre Rodrigues', 'abc123','32568774587','alerodrigues@globo.com','masculino','3408-2122','8135-6832','1962-03-19', 
'AV DR ADHEMAR PEREIRA DE BARROS',538,'VILA MELHADO',20,24),

(null,'Dieykson Alves Ramos', 'abc123','24158745820','dieyk@gmail.com','masculino','3349-0599','9933-4567','1963-04-20',
'R 01',144,'SANTA CRUZ',20,25),

(null,'Tiago Silva Alves', 'abc123','35649057841','trioburitis@gmail.com','masculino','3710-8101','8161-1795','1964-05-21',
'R MAJOR NATINHO',157,'JARDIM ARAUJO',20,26),

(null,'Helen Martins', 'abc123','31652045984','helen.cassia@gmail.com','feminino','3297-0014','8509-9578','1965-06-22',
'AV N SRA DA CONCEICAO',35,'FRANCOS',20,27),

(null,'Jane Cleide', 'abc123','34682254654','janeavelino@gmail.com','feminino','3297-0015','9324-6417','1966-07-23',
'AV MONTE SIAO',1725,'PORTO',20,28),

(null,'Gustavo de Araújo','abc123','96831569742','guga.araujo@outlook.com.br','masculino','3965-1920','7819-2869','1967-08-24',
'R LAURA LOPES DE ALMEIDA',188,'VILA FATIMA',20,29),

(null,'Lídia Matos','abc123','39587359854','lidia.matos@gmail.com','feminino','3487-1903','8288-5999','1968-08-25',
'RUA DR JOAO MENDES',228,'MONTENEGRO',25,30),

(null,'Rodrigo Eric de Jesus','abc123','36210236501','rodrigoericdejesus@gmail.com','masculino','3245-7894','9823-4094','1969-09-26',
'RUA GONCALVES LEDO',394,'VILA INDUSTRIA',25,31),

(null,'Tomaz Alves','abc123','97485716028','tomaz.a@gmail.com','masculino','3349-3703','9245-1104','1970-09-27',
'RUA ARI VIEIRA',542,'ESTUFA II',25,1),

(null,'Anabel Macedo','abc123','34697845120','anabeautiful@gmail.com','feminino','3340-8823','8168-7961','1971-10-28',
'R HERCULANO LIVRAMENTO',499,'JARDIM IRIS',25,2),

(null,'Priscilla Teixeira','abc123','34687541524','teixeira.priscilla@gmail.com','feminino','4103-1983','9647-3282','1972-10-29',
'AV RAIMUNDO PEREIRA MAGALHAES',2500,'SANTA CRUZ',25,2),

(null,'Jessica Emanoeli','abc123','91847538749','emanoeli@bol.com.br','feminino','4101-5282','8468-2132','1973-11-30',
'AV RUI BARBOSA',989,'VILA SOROCABAN',25,6),

(null,'Rosana Souza','abc123','34587451201','rosouza@globomail.com','feminino','4101-1087','9126-2878','1974-12-31',
'AV JOSE BONIFACIO',98,'JARDIM MARILAN',22,8),

(null,'Edgar Quadros','abc123','24697854123','edquadros@gmail.com','masculino','3347-5998','9591-9302','1975-01-02',
'AV HEITOR ALVES GOMES',887,'VILA RODRIGUES',22,10),

(null,'Wdson Alves da Silva','abc123','36487594581','wdsonalves@gmail.com','masculino','3347-7363','9253-5663','1975-02-03',
'RUA VISTA ALEGRE',455,'AGUA DOCE',22,19),

(null,'Helio José','abc123','34875854789','ton.ze@gmail.com','masculino','3024-8420','8638-7408','1976-03-04', 
'PC DR. ANTONIO DA CUNHA',56,'JARDIM BRASIL',22,11),

(null,'Lano Alves Costa','abc123','12345125012','alvescosta@globo.com','masculino','3327-1742','9519-9464','1976-03-09',
'AV ANTONIO G DA SILVA',640,'VILA BRASILAND',22,22),

(null,'Carlos Alberto Lima Costa','abc123','95863215420','calc@gmail.com','masculino','3047-8232','9634-8969','1976-05-21',
'AV PENSILVANIA',624,'JARDIM SIESTA',22,22),

(null,'Maycon Ferreira da Silva','abc123','12345678912','ferreiralouco@gmail.com','masculino','3331-4243','9240-0547','1977-06-23',
'AV BRASIL',29,'BOM SUCESSO',2,62),

(null,'Karleny Mendes','abc123','23568987456','kakamendes@yahoo.com.br','feminino','3083-8450','9616-1729','1978-07-25', 
'R NOVA YORK',1397,'JARDIM BRASIL',1,61),

(null,'Andreia Sousa','abc123','32694875412','deiasousa@gmail.com','feminino','3048-3477','8546-9462','1978-08-24',
'RUA PRUDENTE DE MORAES',425,'CENTRO',7,61),

(null,'Giselle Mazasso','abc123','236542125','gimazasso@globo.com','feminino','3434-5916','9961-7171','1979-09-12',
'AV.DA SAUDADE',18264,'VILA QUEIROZ',3,61),

(null,'Alessandro Vieira','abc123','35698745120','ale.vieira@gmail.com','masculino','3374-2336','9999-6550','1979-10-15',
'AV RIO GRANDE',1273,'ESPLANADA',3,61),

(null,'Lukas Silva','abc123','12135468455','lukas.si@gmail.com','masculino','3465-2206','8128-2263','1980-11-16',
'R IRINEU PEREIRA DA SILVA',755,'VL STA CRUZ',23,61),

(null,'Rodrigo Menezes','abc123','23887445845','drigomenezes@globo.com','masculino','3465-2322','8479-7374','1981-11-17',
'AV COLARES JUNIOR',870,'SALOMAO DRUMON',25,61),

(null,'Maria do Carmo Vidal','abc123','99687584512','cavidal@gmail.com','feminino','3393-6846','9579-0880','1981-11-18',
'AVENIDA 21 DE DEZEMBRO',907,'VILA NOVA BOTU',27,61),

(null,'Paula Botelho','abc123','32554987458','paulinia@gmail.com','feminino','3037-9725','9303-9306','1981-11-19',
'RUA EPITACIO PESSOA',585,'VILA HARO',28,61),

(null,'Evanilde Souza','abc123','31548278012','eva@yahoo.com.br','feminino','3399-3889','9548-0214','1981-11-20',
'AV ATALIBA LEONEL',213,'JARDIM MARSOLA',30,61),

(null,'Elivânia Botelho','abc123','96784525412','livania@globo.com','feminino','3328-6117','8121-3322','1981-11-21',
'AV LUIS OSORIO',1075,'VILA SAUL BORS',1,61),

(null,'Randerson Alves de Jesus','abc123','34658741254','rande.jesus@globomail.com','masculino','3083-6907','8468-9921','1981-11-22',
'AV FERNANDO COSTA',466,'CONJUNTO HABITACIONAL',1,80),

(null,'Allison Anselmo Folha','abc123','72469871203','alissonfolhadireito@ucb.com.br','masculino','4103-8006','9372-2165','1982,12-10',
'AV CEL.ANTONIO P.COSTA',1027,'JARDIM BONGIOVANI',12,80),

(null,'Jéssica Alves de Souza','abc123','31369870245', 'jesouza@gvt.com.br','feminino','3468-1592','9164-4140','1982-07-20',
'RUA XV DE NOVEMBRO',534,'JARDIM DO CARMO',15,80),

(null,'Márcia Rosa','abc123','72854369451','marciarosadoidinha@gmail.com','feminino','3702-3888','8599-5010','1995-06-16',
'AV CEL ANTONIO PAULINO DA COSTA',782,'SANTAN CRUZ',9,80),

(null,'Vinicius Passos','abc123','02354898745','vinicius.passos@caixa.com.br','masculino','3362-9457','8191-6565','1994-05-15',
'RUA RIO BRANCO',22-26,'VILA PACIFICO',31,80),

(null,'Nobert Oliveira','abc123','65487945873','nobert.direito@uniceub.com','masculino','3546-0676','9506-9062','1993-02-14',
'AV ROZO GARCIA FERNANDES',542,'PARQUE TERRAS',3,80),

(null,'Carol Cardoso','abc123','69120458731','cardoso.carol@globomail.com','feminino','3347-7363','8638-7408','1992-05-20',
'AV AGENOR DE CARVALHO',191,'JARDIM PROENCA',31,80),

(null,'Jessica Paiva','abc123','25488733651','paiva.je@globo.com','feminino','3327-5452','9253-5661','1991-02-05',
'RUA AMBROZIO RODRIGUES',5,'JARDIM MARINA',7,80),

(null,'Maria Jose Tomaz Gomes','abc123','65895784587','marizegomes@globo.com','feminino','3245-6990','9231-0088','1996-05-06',
'AV LARANJEIRAS',612,'CENTRO',8,80),

(null,'Gilberto Pereira Nogueira','abc123','34659587451','gil.pereira@gmail.com','masculino','3233-4684','8117-7570','1997-06-05',
'R DR JOAO GUIAO',1527,'JD SANTA CRUZ',9,80),

(null,'Francisco De Paula Soriano','abc123','26459810265','chico2soriano@globo.com','masculino','3361-5337','9985-9287','1997-08-10',
'AV MARGINAL',63,'BELA VISTA',1,80),

(null,'Marcio Calderoni Nogueira','abc123','36498745120','ma.calderoni@uol.com.br','masculino','3355-5040','7400-8512','1997-09-24',
'AV BRASIL',96,'RES STA TEREZA',17,80),

(null,'Marcos Adriano Tiengo','abc123','96325874123','tiengo.marcos@yahoo.com.br','masculino','3336-8045','9985-7447','1998-10-13',
'AV PRESIDENTE VARGAS',186,'CENTRO',19,80),

(null,'Ana Rita Porfirio Pinto','abc123','36569812360','ana.porfirio.p@outlook.com','feminino','3366-3367','9249-6447','1999-05-12',
'RUA MARQUES DO VALE',47,'JARDIM CRUZADO',25,80),

(null,'Jorge Daher Sobrinho','abc123','73914685203','dahersobrinho@gmail.com','masculino','3458-3686','8614-6557','1998-10-20',
'RUA MACIR RAMAZINI',934,'MARCIOLANDIA',29,80),

(null,'Elsa Silva Sousa Gomes','abc123','76984758612','elsaletitgo@globo.com','feminino','3274-0466','7400-9986','1998-12-15',
'AV PAULO AZZINI',931,'IPIRANGA',22,80),

(null,'Reginaldo Messias Jacomini','abc123','16907845230','eusouomessias@gmail.com','masculino','3082-7239','9964-5383','1999-07-07',
'RUA GERONIMO ALVES DIAS',260,'SAO MIGUEL',24,80),

(null,'Aparecida Pereira De Campos','abc123','94857215436','aparecida_pereira@gmail.com','feminino','3375-7139','8464-3726','1998-09-09',
'RUA ARMANDO SALLES DE OLIVEIRA',275,'CENTRO',21,38),

(null,'Ivanir Gualberto Pereira','abc123','29487561240','ivanir_gualberto@globo.com','masculino','3331-4172','9559-4796','1997-09-05',
'RUA PREFEITO JOSE MARIA PITELLA',85,'VARGEM GRANDE',2,38),

(null,'Luiz Antonio Dias ','abc123','156879845876','luizad@gmail.com','masculino','3301-2253','8517-4160','2000-01-15',
'RUA FRANCISCO RUIZ',310,'CENTRO',5,38);



INSERT INTO vb_matricula(id_matricula, cod_matricula, id_turma)
VALUES
(null,15498620,1),(null,15498620,2),(null,15498620,3),(null,15498620,4),(null,15498620,5),(null,15498620,6),(null,15498620,7),
(null,15498620,8),(null,15498620,9),(null,15498620,10),(null,15498620,11),(null,15498620,12),(null,15498620,13),(null,15498620,14),
(null,15498621,2),(null,15498621,4),(null,15498621,6),(null,15498621,8),(null,15498621,10),(null,15498621,12),(null,15498621,14),
(null,15498621,16),(null,15498621,18),(null,15498622,2),(null,15498622,22),(null,15498622,32),(null,15498622,42),(null,15498622,52),
(null,15498622,62),(null,15498622,72),(null,15498622,82),(null,15498623,26),(null,15498623,36),(null,15498623,46),(null,15498624,8),
(null,15498624,18),(null,15498624,28),(null,15498624,38),(null,15498624,48),(null,15498625,10),(null,15498625,20),(null,15498625,30),
(null,15498625,40),(null,15498625,50),(null,15498625,60),(null,15498625,70),(null,15498626,31),(null,15498626,32),(null,15498626,33),
(null,15498626,34),(null,15498626,35),(null,15498626,36),(null,15498626,37),(null,15498626,38),(null,15498626,39),(null,15498626,40),
(null,15498627,31),(null,15498627,32),(null,15498627,33),(null,15498627,34),(null,15498627,35),(null,15498627,36),(null,15498627,37),
(null,15498627,38),(null,15498627,39),(null,15498627,40),(null,15498628,31),(null,15498628,32),(null,15498628,33),(null,15498628,34),
(null,15498628,35),(null,15498628,36),(null,15498628,37),(null,15498628,38),(null,15498628,39),(null,15498628,40),(null,15498629,31),
(null,15498629,32),(null,15498629,33),(null,15498629,34),(null,15498629,35),(null,15498629,36),(null,15498629,37),(null,15498629,38),
(null,15498629,39),(null,15498629,40),(null,15498630,31),(null,15498630,32),(null,15498630,33),(null,15498630,34),(null,15498630,35),
(null,15498630,36),(null,15498630,37),(null,15498630,38),(null,15498630,39),(null,15498630,40),(null,15498631,31),(null,15498631,32),
(null,15498631,33),(null,15498631,34),(null,15498631,35),(null,15498631,36),(null,15498631,37),(null,15498631,38),(null,15498631,39),
(null,15498631,40),(null,15498632,31),(null,15498632,32),(null,15498632,33),(null,15498632,34),(null,15498632,35),(null,15498632,36),
(null,15498632,37),(null,15498632,38),(null,15498632,39),(null,15498632,40),(null,15498633,31),(null,15498633,32),(null,15498633,33),
(null,15498633,34),(null,15498633,35),(null,15498633,36),(null,15498633,37),(null,15498633,38),(null,15498633,39),(null,15498633,40),
(null,15498634,31),(null,15498634,32),(null,15498634,33),(null,15498634,34),(null,15498634,35),(null,15498634,36),(null,15498634,37),
(null,15498634,38),(null,15498634,39),(null,15498634,40),(null,15498635,51),(null,15498635,52),(null,15498635,53),(null,15498635,54),
(null,15498635,55),(null,15498635,56),(null,15498635,57),(null,15498635,58),(null,15498635,59),(null,15498635,60),(null,15498636,51),
(null,15498636,52),(null,15498636,53),(null,15498636,54),(null,15498636,55),(null,15498636,56),(null,15498636,57),(null,15498636,58),
(null,15498636,59),(null,15498636,60),(null,15498637,51),(null,15498637,52),(null,15498637,53),(null,15498637,54),(null,15498637,55),
(null,15498637,56),(null,15498637,57),(null,15498637,58),(null,15498637,59),(null,15498637,60),(null,15498638,51),(null,15498638,52),
(null,15498638,53),(null,15498638,54),(null,15498638,55),(null,15498638,56),(null,15498638,57),(null,15498638,58),(null,15498638,59),
(null,15498638,60),(null,15498639,51),(null,15498639,52),(null,15498639,53),(null,15498639,54),(null,15498639,55),(null,15498639,56),
(null,15498639,57),(null,15498639,58),(null,15498639,59),(null,15498639,60),(null,15498640,51),(null,15498640,52),(null,15498640,53),
(null,15498640,54),(null,15498640,55),(null,15498640,56),(null,15498640,57),(null,15498640,58),(null,15498640,59),(null,15498640,60),
(null,15498641,51),(null,15498641,52),(null,15498641,53),(null,15498641,54),(null,15498641,55),(null,15498641,56),(null,15498641,57),
(null,15498641,58),(null,15498641,59),(null,15498641,60),(null,15498642,51),(null,15498642,52),(null,15498642,53),(null,15498642,54),
(null,15498642,55),(null,15498642,56),(null,15498642,57),(null,15498642,58),(null,15498642,59),(null,15498642,60),(null,15498643,51),
(null,15498643,52),(null,15498643,53),(null,15498643,54),(null,15498643,55),(null,15498643,56),(null,15498643,57),(null,15498643,58),
(null,15498643,59),(null,15498643,60),(null,15498643,51),(null,15498643,52),(null,15498643,53),(null,15498643,54),(null,15498643,55),
(null,15498643,56),(null,15498643,57),(null,15498643,58),(null,15498643,59),(null,15498643,60),(null,15498644,51),(null,15498644,52),
(null,15498644,53),(null,15498644,54),(null,15498644,55),(null,15498644,56),(null,15498644,57),(null,15498644,58),(null,15498644,59),
(null,15498644,60),(null,15498645,51),(null,15498645,52),(null,15498645,53),(null,15498645,54),(null,15498645,55),(null,15498645,56),
(null,15498645,57),(null,15498645,58),(null,15498645,59),(null,15498645,60),
(null,15498646,51),(null,15498646,52),(null,15498646,53),(null,15498646,54),(null,15498646,55),(null,15498646,56),(null,15498646,57),
(null,15498646,58),(null,15498647,59),(null,15498647,60),(null,15498647,51),(null,15498647,52),(null,15498647,53),(null,15498647,54),
(null,15498647,55),(null,15498647,56),(null,15498647,57),(null,15498647,58),(null,15498647,59),(null,15498647,60),(null,15498647,71),
(null,15498647,72),(null,15498648,73),(null,15498648,74),(null,15498648,75),(null,15498648,76),(null,15498648,77),(null,15498648,78),
(null,15498648,79),(null,15498648,80),(null,15498649,71),(null,15498649,72),(null,15498649,73),(null,15498649,74),(null,15498649,75),
(null,15498649,76),(null,15498649,77),(null,15498649,78),(null,15498649,79),(null,15498649,80),(null,15498650,71),(null,15498650,72),
(null,15498650,73),(null,15498650,74),(null,15498650,75),(null,15498650,76),(null,15498650,77),(null,15498650,78),(null,15498650,79),
(null,15498650,80),
(null,15498651,71),(null,15498651,72),(null,15498651,73),(null,15498651,74),(null,15498651,75),(null,15498651,76),(null,15498651,77),
(null,15498651,78),(null,15498651,79),(null,15498651,80),(null,15498652,71),(null,15498652,72),(null,15498652,73),(null,15498652,74),
(null,15498652,75),(null,15498652,76),(null,15498652,77),(null,15498652,78),(null,15498652,79),(null,15498652,80),(null,15498653,71),
(null,15498653,72),(null,15498653,73),(null,15498653,74),(null,15498653,75),(null,15498653,76),(null,15498653,77),(null,15498653,78),
(null,15498653,79),(null,15498653,80),(null,15498654,71),(null,15498654,72),(null,15498654,73),(null,15498654,74),(null,15498654,75),
(null,15498654,76),(null,15498654,77),(null,15498654,78),(null,15498654,79),(null,15498654,80),(null,15498655,81),(null,15498655,82),
(null,15498655,83),(null,15498655,84),(null,15498655,85),(null,15498655,86),(null,15498655,87),(null,15498656,81),(null,15498656,82),
(null,15498656,83),(null,15498656,84),(null,15498656,85),(null,15498656,86),(null,15498656,87),(null,15498657,81),(null,15498657,82),
(null,15498657,83),(null,15498657,84),(null,15498657,85),(null,15498657,86),(null,15498657,87),(null,15498658,68),(null,15498658,81),
(null,15498658,82),(null,15498658,83),(null,15498658,84),(null,15498658,85),(null,15498658,86),(null,15498658,87),(null,15498659,81),
(null,15498659,82),(null,15498659,83),(null,15498659,84),(null,15498659,85),(null,15498659,86),(null,15498659,87),(null,15498660,81),
(null,15498660,82),(null,15498660,83),(null,15498660,84),(null,15498660,85),(null,15498660,86),(null,15498660,87),(null,15498661,81),
(null,15498661,82),(null,15498661,83),(null,15498661,84),(null,15498661,85),(null,15498661,86),(null,15498661,87),(null,15498662,1),
(null,15498662,2),(null,15498662,3),(null,15498662,4),(null,15498662,5),(null,15498662,6),(null,15498662,7),(null,15498662,8),
(null,15498662,9),(null,15498662,10),(null,15498662,11),(null,15498662,12),(null,15498662,13),(null,15498662,14),(null,15498662,15),
(null,15498662,16),(null,15498662,17),(null,15498662,18),(null,15498662,19),(null,15498662,20),(null,15498662,21),(null,15498662,22),
(null,15498662,23),(null,15498662,24),(null,15498662,25),(null,15498662,26),(null,15498662,27),(null,15498662,28),(null,15498662,29),
(null,15498663,1),(null,15498663,2),(null,15498663,3),(null,15498663,4),(null,15498663,5),(null,15498663,6),(null,15498663,7),
(null,15498663,8),(null,15498663,9),(null,15498663,10),(null,15498663,11),(null,15498663,12),(null,15498663,13),(null,15498663,14),
(null,15498663,15),(null,15498663,16),(null,15498663,17),(null,15498663,18),(null,15498663,19),(null,15498663,20),(null,15498663,21),
(null,15498663,22),(null,15498663,23),(null,15498663,24),(null,15498663,25),(null,15498663,26),(null,15498663,27),(null,15498663,28),
(null,15498663,29),
(null,15498664,1),(null,15498664,2),(null,15498664,3),(null,15498664,4),(null,15498664,5),(null,15498664,6),(null,15498664,7),
(null,15498664,8),(null,15498664,9),(null,15498664,10),(null,15498664,11),(null,15498664,12),(null,15498664,13),(null,15498664,14),
(null,15498664,15),(null,15498664,16),(null,15498664,17),(null,15498664,18),(null,15498664,19),(null,15498664,20),(null,15498664,21),
(null,15498664,22),(null,15498664,23),(null,15498664,24),(null,15498664,25),(null,15498664,26),(null,15498664,27),(null,15498664,28),
(null,15498664,29),
(null,15498665,1),(null,15498665,2),(null,15498665,3),(null,15498665,4),(null,15498665,5),(null,15498665,6),(null,15498665,7),
(null,15498665,8),(null,15498665,9),(null,15498665,10),(null,15498665,11),(null,15498665,12),(null,15498665,13),(null,15498665,14),
(null,15498665,15),(null,15498665,16),(null,15498665,17),(null,15498665,18),(null,15498665,19),(null,15498665,20),(null,15498665,21),
(null,15498665,22),(null,15498665,23),(null,15498665,24),(null,15498665,25),(null,15498665,26),(null,15498665,27),(null,15498665,28),
(null,15498665,29),
(null,15498666,1),(null,15498666,2),(null,15498666,3),(null,15498666,4),(null,15498666,5),(null,15498666,6),(null,15498666,7),
(null,15498666,8),(null,15498666,9),(null,15498666,10),(null,15498666,11),(null,15498666,12),(null,15498666,13),(null,15498666,14),
(null,15498666,15),(null,15498666,16),(null,15498666,17),(null,15498666,18),(null,15498666,19),(null,15498666,20),(null,15498666,21),
(null,15498666,22),(null,15498666,23),(null,15498666,24),(null,15498666,25),(null,15498666,26),(null,15498666,27),(null,15498666,28),
(null,15498666,29),
(null,15498667,1),(null,15498667,2),(null,15498667,3),(null,15498667,4),(null,15498667,5),(null,15498667,6),(null,15498667,7),
(null,15498667,8),(null,15498667,9),(null,15498667,10),(null,15498667,11),(null,15498667,12),(null,15498667,13),(null,15498667,14),
(null,15498667,15),(null,15498667,16),(null,15498667,17),(null,15498667,18),(null,15498667,19),(null,15498667,20),(null,15498667,21),
(null,15498667,22),(null,15498667,23),(null,15498667,24),(null,15498667,25),(null,15498667,26),(null,15498667,27),(null,15498667,28),
(null,15498667,29),
(null,15498668,1),(null,15498668,2),(null,15498668,3),(null,15498668,4),(null,15498668,5),(null,15498668,6),(null,15498668,7),
(null,15498668,8),(null,15498668,9),(null,15498668,10),(null,15498668,11),(null,15498668,12),(null,15498668,13),(null,15498668,14),
(null,15498668,15),(null,15498668,16),(null,15498668,17),(null,15498668,18),(null,15498668,19),(null,15498668,20),(null,15498668,21),
(null,15498668,22),(null,15498668,23),(null,15498668,24),(null,15498668,25),(null,15498668,26),(null,15498668,27),(null,15498668,28),
(null,15498668,29),
(null,15498669,1),(null,15498669,2),(null,15498669,3),(null,15498669,4),(null,15498669,5),(null,15498669,6),(null,15498669,7),
(null,15498669,8),(null,15498669,9),(null,15498669,10),(null,15498669,11),(null,15498669,12),(null,15498669,13),(null,15498669,14),
(null,15498669,15),(null,15498669,16),(null,15498669,17),(null,15498669,18),(null,15498669,19),(null,15498669,20),(null,15498669,21),
(null,15498669,22),(null,15498669,23),(null,15498669,24),(null,15498669,25),(null,15498669,26),(null,15498669,27),(null,15498669,28),
(null,15498669,29),
(null,15498670,1),(null,15498670,2),(null,15498670,3),(null,15498670,4),(null,15498670,5),(null,15498670,6),(null,15498670,7),
(null,15498670,8),(null,15498670,9),(null,15498670,10),(null,15498670,11),(null,15498670,12),(null,15498670,13),(null,15498670,14),
(null,15498670,15),(null,15498670,16),(null,15498670,17),(null,15498670,18),(null,15498670,19),(null,15498670,20),(null,15498670,21),
(null,15498670,22),(null,15498670,23),(null,15498670,24),(null,15498670,25),(null,15498670,26),(null,15498670,27),(null,15498670,28),
(null,15498670,29),
(null,15498671,1),(null,15498671,2),(null,15498671,3),(null,15498671,4),(null,15498671,5),(null,15498671,6),(null,15498671,7),
(null,15498671,8),(null,15498671,9),(null,15498671,10),(null,15498671,11),(null,15498671,12),(null,15498671,13),(null,15498671,14),
(null,15498671,15),(null,15498671,16),(null,15498671,17),(null,15498671,18),(null,15498671,19),(null,15498671,20),(null,15498671,21),
(null,15498671,22),(null,15498671,23),(null,15498671,24),(null,15498671,25),(null,15498671,26),(null,15498671,27),(null,15498671,28),
(null,15498671,29),
(null,15498672,1),(null,15498672,2),(null,15498672,3),(null,15498672,4),(null,15498672,5),(null,15498672,6),(null,15498672,7),
(null,15498672,8),(null,15498672,9),(null,15498672,10),(null,15498672,11),(null,15498672,12),(null,15498672,13),(null,15498672,14),
(null,15498672,15),(null,15498672,16),(null,15498672,17),(null,15498672,18),(null,15498672,19),(null,15498672,20),(null,15498672,21),
(null,15498672,22),(null,15498672,23),(null,15498672,24),(null,15498672,25),(null,15498672,26),(null,15498672,27),(null,15498672,28),
(null,15498672,29),
(null,15498620,1),(null,15498620,2),(null,15498620,3),(null,15498620,4),(null,15498620,5),(null,15498620,6),(null,15498620,7),
(null,15498620,8),(null,15498620,9),(null,15498620,10),(null,15498620,11),(null,15498620,12),(null,15498620,13),(null,15498620,14),
(null,15498620,15),(null,15498620,16),(null,15498620,17),(null,15498620,18),(null,15498620,19),(null,15498620,20),(null,15498620,21),
(null,15498620,22),(null,15498620,23),(null,15498620,24),(null,15498620,25),(null,15498620,26),(null,15498620,27),(null,15498620,28),
(null,15498620,29),(null,15498621,1),(null,15498621,2),(null,15498621,3),(null,15498621,4),(null,15498621,5),(null,15498621,6),(null,15498621,7),
(null,15498621,8),(null,15498621,9),(null,15498621,10),(null,15498621,11),(null,15498621,12),(null,15498621,13),(null,15498621,14),
(null,15498621,15),(null,15498621,16),(null,15498621,17),(null,15498621,18),(null,15498621,19),(null,15498621,20),(null,15498621,21),
(null,15498621,22),(null,15498621,23),(null,15498621,24),(null,15498621,25),(null,15498621,26),(null,15498621,27),(null,15498621,28),
(null,15498621,29),
(null,15498622,1),(null,15498622,2),(null,15498622,3),(null,15498622,4),(null,15498622,5),(null,15498622,6),(null,15498622,7),
(null,15498622,8),(null,15498622,9),(null,15498622,10),(null,15498622,11),(null,15498622,12),(null,15498622,13),(null,15498622,14),
(null,15498622,15),(null,15498622,16),(null,15498622,17),(null,15498622,18),(null,15498622,19),(null,15498622,20),(null,15498622,21),
(null,15498622,22),(null,15498622,23),(null,15498622,24),(null,15498622,25),(null,15498622,26),(null,15498622,27),(null,15498622,28),
(null,15498622,29);

INSERT INTO graficomodalidade(id_graficomodalidade,nome,qtd_alunos)VALUES
(null, 'ALONGAMENTO ','20'),
(null, 'GINÁSTICA LOCALIZADA ','20'),
(null, 'HIDROGINÁSTICA  ','35'),
(null, 'JUMP  ','48'),
(null, 'NATAÇÃO INICIAÇÃO ADULTO ','40'),
(null, 'NATAÇÃO INTERMEDIÁRIO ADULTO ','72'),
(null, 'NATAÇÃO AVANÇADO ADULTO ','15'),
(null, 'PILATES SOLO ','29'),
(null, 'TREINAMENTO FUNCIONAL ','34');


