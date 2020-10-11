# API PHP

API simples que tem como recursos usuário, endereço, cidade e estados.

## Recursos

### Usuário

- id: Unsigned BigInt
- nome: String(varchar)
- endereco_id: Unsigned BigInt
- cidade_id : Unsigned BigInt
- estado_id: Unsigned BigInt

### Endereço

- id: Unsigned BigInt
- logradouro: String(varchar)

### Cidade

- id: Unsigned BigInt
- nome: String(varchar)

### Estado

- id: Unsigned BigInt
- abreviacao: String(varchar)

## Endpoints

Como não alterei no RouteServiceProvider, por padrão, todos os endpoints do Laravel de api são precedidos pelo prefixo /api. 

### Usuário
- Lista de usuários

    `GET /api/usuarios/findall.php`

- Usuários por id

    `GET /api/usuarios/find.php?id={id}`

- Criar novo usuário

    `POST /api/usuarios/create.php`

- Atualizar usuário
    
    `PATCH /api/usuarios/update.php`

- Deletar usuário

    `DELETE /api/usuarios/delete.php`

### Endereços
- Obter endereços

    `GET /api/enderecos/findall.php`

- Obter endereço por id

    `GET /api/enderecos/find.php?id={id}`

### Cidades
- Obter Cidades

    `GET /api/cidades/findall.php`

- Obter Cidades por id

    `GET /api/cidades/find.php?id={id}`

- Obter total de usuários cadastrados por cidade

    `GET /api/cidades/num-usuarios.php`

- Obter total de usuários cadastrados por id da cidade

    `GET /api/cidades/{id}/num-usuarios-cidadeid.php?id={id}`

### Estados
- Obter Estados

    `GET /api/estados/findall.php`

- Obter Estado por id

    `GET /api/estados/find.php?id={id}`

- Obter total de usuários cadastrados por estado

    `GET /api/estados/num-usuarios.php`

- Obter total de usuários cadastrados por id de estado

    `GET /api/estados/{id}/num-usuarios-estadoid.php?id={id}`
    
## Testes

Para os testes utilizei o Insomnia rodando no servidor local com:
    
    php -S localhost:8000
