
**Documentation API**

## Produit
#### Récupérer la liste des produits avec redondance 

`GET /api/produit/all`


*Request*
```json
{
	"brand": "Marque",
	"search": "Boîte de recherche",
	"gender": "homme",
	"type": "Eau de parfum",
}
```
*Response*  
```json
{
    "total": 11,
    "page": 1,
    "data": [
        {
            "num_produit": 91,
            "libelle_produit": "Conn-Larkin",
            "marque": "Donnelly, Hodkiewicz and DuBuque",
            "type": "parfum",
            "prixu_produit": 600.0,
            "discount_produit": 17.051,
            "url_produit": "copie.com",
            "shippingcost_produit": 38.22,
            "profit_produit": 36.932,
            "attributes_produit": {
                "genre": "femme",
                "image": [
                    "https://empiric-bats.000webhostapp.com/Image1.png"
                ],
                "volume": "50ml"
            },
            "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio.",
            "id_fournisseur": []
        },



```
Json  
 	
#### Récupérer la liste des produits sans redondance 

`GET /api/produit`


*Request*
```json
{
	"brand": "Marque",
	"search": "Boîte de recherche",
	"gender": "homme",
	"type": "Eau de parfum",
}
```
*Response*  
```json
{
    "total": 11,
    "page": 1,
    "data": [
        {
            "num_produit": 91,
            "libelle_produit": "Conn-Larkin",
            "marque": "Donnelly, Hodkiewicz and DuBuque",
            "type": "parfum",
            "prixu_produit": 600.0,
            "discount_produit": 17.051,
            "url_produit": "copie.com",
            "shippingcost_produit": 38.22,
            "profit_produit": 36.932,
            "attributes_produit": {
                "genre": "femme",
                "image": [
                    "https://empiric-bats.000webhostapp.com/Image1.png"
                ],
                "volume": "50ml"
            },
            "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio.",
            "id_fournisseur": []
        },



```
Json  
 	
	

------------
#### Récupérer les produits similaires du produit

`GET /api/produit/similar/{idProduit}  `

Request
```json
{

}
```
*Response  *
```json
[
    {
        "num_produit": 81,
        "libelle_produit": "Conn-Larkin",
        "marque": "Donnelly, Hodkiewicz and DuBuque",
        "type": "parfum",
        "prixu_produit": 314.902,
        "discount_produit": 17.051,
        "url_produit": "kunze.org",
        "shippingcost_produit": 38.22,
        "profit_produit": 36.932,
        "attributes_produit": {
            "genre": "homme",
            "image": [
                "https://empiric-bats.000webhostapp.com/Image1.png"
            ],
            "volume": "50ml"
        },
        "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio.",
        "id_fournisseur": []
    }
]

```
Json (Produit array[]) 

------------
#### Récupérer les informations d'un produit

` GET  /api/produit/{idProduit}   `

Request
```json
{

}
```
*Response  *
```json
 
{
    "num_produit": 91,
    "libelle_produit": "Conn-Larkin",
    "marque": "Donnelly, Hodkiewicz and DuBuque",
    "type": "parfum",
    "prixu_produit": 150.0,
    "discount_produit": 17.051,
    "url_produit": "copie.com",
    "shippingcost_produit": 38.22,
    "profit_produit": 36.932,
    "attributes_produit": {
        "genre": "femme",
        "image": [
            "https://empiric-bats.000webhostapp.com/Image1.png"
        ],
        "volume": "50ml"
    },
    "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio.",
    "id_fournisseur": []
}

```

Json (Produit) 

------------
#### Supprimer un produit

` DELETE /api/produit/{idProduit}`

Request
```json
{

}
```
*Response  *
```json
{

}
```

------------
####  Editer un produit

`POST /api/produit/{idProduit}/edit` 

Request

```json
{
            "libelle_produit": "Conn-Larkin",
            "marque": "Donnelly, Hodkiewicz and DuBuque",
            "type": "parfum",
            "prixu_produit": 138.902,
            "discount_produit": 17.051,
            "url_produit": "kenziii.org",
            "shippingcost_produit": 38.22,
            "profit_produit": 36.932,
            "attributes_produit": {
                "genre": "homme",
                "image": [
                    "https://empiric-bats.000webhostapp.com/Image1.png"
                ],
                "volume": "50ml"
            },
            "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio."
        }
		
```
*Response  *
```json
 
{
    "num_produit": 91,
    "libelle_produit": "Conn-Larkin",
    "marque": "Donnelly, Hodkiewicz and DuBuque",
    "type": "parfum",
    "prixu_produit": 600.0,
    "discount_produit": 17.051,
    "url_produit": "copie.com",
    "shippingcost_produit": 38.22,
    "profit_produit": 36.932,
    "attributes_produit": {
        "genre": "femme",
        "image": [
            "https://empiric-bats.000webhostapp.com/Image1.png"
        ],
        "volume": "50ml"
    },
    "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio.",
    "id_fournisseur": []
}




```
------------
####  Ajouter un produit

`GET|POST /api/produit/add    `

Request
```json
{
    "num_produit": 91,
    "libelle_produit": "Conn-Larkin",
    "marque": "Donnelly, Hodkiewicz and DuBuque",
    "type": "parfum",
    "prixu_produit": 600.0,
    "discount_produit": 17.051,
    "url_produit": "copie.com",
    "shippingcost_produit": 38.22,
    "profit_produit": 36.932,
    "attributes_produit": {
        "genre": "femme",
        "image": [
            "https://empiric-bats.000webhostapp.com/Image1.png"
        ],
        "volume": "50ml"
    },
    "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio.",
    "id_fournisseur": []
}

```

*Response  *
```json
 
{
    "num_produit": 91,
    "libelle_produit": "Conn-Larkin",
    "marque": "Donnelly, Hodkiewicz and DuBuque",
    "type": "parfum",
    "prixu_produit": 600.0,
    "discount_produit": 17.051,
    "url_produit": "copie.com",
    "shippingcost_produit": 38.22,
    "profit_produit": 36.932,
    "attributes_produit": {
        "genre": "femme",
        "image": [
            "https://empiric-bats.000webhostapp.com/Image1.png"
        ],
        "volume": "50ml"
    },
    "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio.",
    "id_fournisseur": []
}

```



## Login (AgentController)

#### Connexion utilisateur

`GET /api/login_check  `


Request
```json
{
  "username": "baumbach.glennie@gmail.com",
  "password": "test"
}
```

Response
```json
{
	"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1ODA0OTY4NjYsImV4cCI6MTU4MDUwMDQ"
}
```

Pass JWT token on each request the authorization

Authorization: Bearer {token}

**Configuration**

```bash
mkdir config/jwt

openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096

openssl pkey -in private.pem -out config/jwt/public.pem -pubout
```
#### Récupérer la liste des agents

`GET /api/agent  `


Request
```json

```

Response
```json
{
    "total": 5,
    "agent": [
        {
            "id_agent": 36,
            "roles": [
                "ROLE_USER"
            ],
            "email": "baumbach.glennie@gmail.com"
        },

```
#### Récupérer un agent

`GET /api/agent/{idAgent} `


Request
```json

```

Response
```json

{
    "id_agent": 36,
    "roles": [
        "ROLE_USER"
    ],
    "email": "baumbach.glennie@gmail.com"
}


```
#### Liste des orders passer par un agent

`GET /api/agent/{idAgent}/orders `


Request
```json

```

Response
```json
{
    "total": 2,
    "order": [
        {
            "num_cmd": 24,
            "date_cmd": "2020-02-01T22:45:06+00:00",
            "montant_cmd": 598.856,
            "id_agent": {
                "id_agent": 36,
                "roles": [
                    "ROLE_USER"
                ],
                "email": "baumbach.glennie@gmail.com"
            },
            "id_client": {
                "id_client": 251,
                "nom_client": "Georgette",
                "prenom_client": "Hilpert",
                "adresse_client": "5933 Jed Motorway Apt. 980\nEast Bailee, DE 84285-3017",
                "zip_code_client": 92006,
                "country_client": "Burundi",
                "telephone_client": "(819) 320-1666 x96171",
                "email_client": "travon.thiel@yahoo.com"
            },
            "items": [
                {
                    "produit": {
                        "num_produit": 81,
                        "libelle_produit": "Connnn-Larkin",
                        "marque": "Donnelly, Hodkiewicz and DuBuque",
                        "type": "parfum",
                        "prixu_produit": 314.902,
                        "discount_produit": 17.051,
                        "url_produit": "kunze.org",
                        "shippingcost_produit": 38.22,
                        "profit_produit": 36.932,
                        "attributes_produit": {
                            "genre": "homme",
                            "image": [
                                "https://empiric-bats.000webhostapp.com/Image1.png"
                            ],
                            "volume": "50ml"
                        },
                        "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio.",
                        "id_fournisseur": []
                    },
                    "qty": 2,
                    "prix": "315"
                }
            ]
        },



```
------------

## Commande (OrderController)

#### Ajouter une commande pour un client

`POST /api/order/add `


*Request*
> Qty > 0

```json
{
	"id_client": 251,
	"products":[
	{
		"id_produit": 82,
		"qty": 2
	},
	{
		"id_produit": 81,
		"qty": 1
	}
	]
}
```

*Response *
```json
{
    "num_cmd": 25,
    "date_cmd": "2020-02-01T23:19:10+00:00",
    "montant_cmd": 299.42805997999994,
    "id_agent": {
        "id_agent": 36,
        "roles": [
            "ROLE_USER"
        ],
        "email": "baumbach.glennie@gmail.com"
    },
    "id_client": {
        "id_client": 251,
        "nom_client": "Georgette",
        "prenom_client": "Hilpert",
        "adresse_client": "5933 Jed Motorway Apt. 980\nEast Bailee, DE 84285-3017",
        "zip_code_client": 92006,
        "country_client": "Burundi",
        "telephone_client": "(819) 320-1666 x96171",
        "email_client": "travon.thiel@yahoo.com"
    },
    "items": [
        {
            "produit": {
                "num_produit": 82,
                "libelle_produit": "Hermann and Sons",
                "marque": "Bailey LLC",
                "type": "parfum",
                "prixu_produit": 250.077,
                "discount_produit": 2.938,
                "url_produit": "kirlin.com",
                "shippingcost_produit": 6.946,
                "profit_produit": 12.415,
                "attributes_produit": {
                    "genre": "homme",
                    "image": [
                        "https://empiric-bats.000webhostapp.com/Image1.png"
                    ],
                    "volume": "50ml"
                },
                "desc_produit": "Et explicabo illum veniam commodi tempore natus adipisci. Aut dolor earum qui iste et sed. Molestias fuga nesciunt explicabo impedit id autem hic. Modi quae a amet quaerat suscipit ut.",
                "id_fournisseur": []
            },
            "qty": 2,
            "prix": 250.077
        },
        {
            "produit": {
                "num_produit": 81,
                "libelle_produit": "Conn-Larkin",
                "marque": "Donnelly, Hodkiewicz and DuBuque",
                "type": "parfum",
                "prixu_produit": 314.902,
                "discount_produit": 17.051,
                "url_produit": "kunze.org",
                "shippingcost_produit": 38.22,
                "profit_produit": 36.932,
                "attributes_produit": {
                    "genre": "homme",
                    "image": [
                        "https://empiric-bats.000webhostapp.com/Image1.png"
                    ],
                    "volume": "50ml"
                },
                "desc_produit": "Ut sed et necessitatibus quam nobis doloribus voluptatibus neque. Enim ab et quae explicabo eos. Et et tenetur exercitationem veritatis molestiae ex. Molestiae aut ipsum in voluptatum saepe distinctio.",
                "id_fournisseur": []
            },
            "qty": 1,
            "prix": 314.902
        }
    ]
}
```
 Json(\Commande)

------------

#### Récupérer la liste des clients

`GET /api/client/ `


Request
```json
{
	"search": "aymane"
}
```
*Response  *
```json
{

}
```

------------

#### Récupérer un Client

`GET|POST /api/client/{idClient} `

Request
```json
{
	"search": "aymane"
}
```

*Response  *
```json
{

}
```

------------

#### Supprimer un client 

` DELETE /api/client/{idClient}`


*Response  *
```json
{

}
```

------------

#### Ajouter un client 

` GET /api/client/add  `

*Request*
```json
{
	"nom_client": "aymane",
	"prenom_client":"aymane",
	"adresse_client" :"ksikso",
	"zip_code_client":"7200",
	"country_client":"ksikso",
	"telephone_client" :"06503103126",
	"email_client":"ksikso@gmail.com" 
}
```


*Response  *
```json
{

}
```

------------

#### Editer un client

` GET|POST /api/client/{idClient}/edit"  `

Request
```json
{
	"nom": "aymane",
	"prenom":"aymane",
	"adresse" :"ksikso",
    "zipCode":"7200",
    "country":"ksikso",
    "telephone" :"06503103126",
    "Email":"ksikso@gmail.com" 
}
```
