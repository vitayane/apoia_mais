CREATE DATABASE apoiamais;

USE apoiamais;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    senha VARCHAR(255)
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    descricao TEXT,
    data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

ALTER TABLE pedidos ADD COLUMN resposta_voluntario TEXT NULL;
ALTER TABLE pedidos ADD COLUMN visualizado TINYINT DEFAULT 0;


CREATE TABLE sos_alertas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    visualizado TINYINT DEFAULT 0,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);


drop table sos_alertas;

CREATE TABLE chat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    mensagem TEXT NOT NULL,
    remetente ENUM('usuario','bot') NOT NULL,
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
);



select * from usuarios;
select * from pedidos;
select * from sos_alertas;
