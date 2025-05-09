<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Provider;

class Providers extends Component
{

    public function render()
    {
        // Nombre del usuario
        $name = auth()->user()->name;

        $proveedor = Provider::paginate(10);

        // Lista de departamentos
        $departamentos = [
            'Amazonas',
            'Antioquia',
            'Arauca',
            'Atlántico',
            'Bolívar',
            'Boyacá',
            'Caldas',
            'Caquetá',
            'Casanare',
            'Cauca',
            'Cesar',
            'Chocó',
            'Córdoba',
            'Cundinamarca',
            'Guainía',
            'Guaviare',
            'Huila',
            'La Guajira',
            'Magdalena',
            'Meta',
            'Nariño',
            'Norte de Santander',
            'Putumayo',
            'Quindío',
            'Risaralda',
            'San Andrés y Providencia',
            'Santander',
            'Sucre',
            'Tolima',
            'Valle del Cauca',
            'Vaupés',
            'Vichada'
        ];

        //lista de Municipios
        $group = [
            'Amazonas' => [
                'Leticia',
                'El Encanto',
                'La Chorrera',
                'La Pedrera',
                'Mirití-Paraná',
                'Puerto Alegría',
                'Puerto Arica',
                'Puerto Nariño',
                'Pucaurquillo',
                'Tarapacá'
            ],
            'Antioquia' => [
                "Medellín",
                "Abejorral",
                "Abriaquí",
                "Alejandría",
                "Amagá",
                "Amalfi",
                "Andes",
                "Angelópolis",
                "Angostura",
                "Anorí",
                "Anzá",
                "Apartadó",
                "Arboletes",
                "Argelia",
                "Armenia",
                "Barbosa",
                "Bello",
                "Belmira",
                "Betania",
                "Betulia",
                "Briceño",
                "Buriticá",
                "Cáceres",
                "Caicedo",
                "Caldas",
                "Campamento",
                "Cañasgordas",
                "Caracolí",
                "Caramanta",
                "Carepa",
                "Carolina del Príncipe",
                "Caucasia",
                "Chigorodó",
                "Cisneros",
                "Ciudad Bolívar",
                "Cocorná",
                "Concepción",
                "Concordia",
                "Copacabana",
                "Dabeiba",
                "Donmatías",
                "Ebéjico",
                "El Bagre",
                "Entrerríos",
                "Envigado",
                "Fredonia",
                "Frontino",
                "Giraldo",
                "Girardota",
                "Gómez Plata",
                "Granada",
                "Guadalupe",
                "Guarne",
                "Guatapé",
                "Heliconia",
                "Hispania",
                "Itagüí",
                "Ituango",
                "Jardín",
                "Jericó",
                "La Ceja",
                "La Estrella",
                "La Pintada",
                "La Unión",
                "Liborina",
                "Maceo",
                "Marinilla",
                "Montebello",
                "Murindó",
                "Mutatá",
                "Nariño",
                "Necoclí",
                "Olaya",
                "Peñol",
                "Peque",
                "Pueblorrico",
                "Puerto Berrío",
                "Puerto Nare",
                "Puerto Triunfo",
                "Remedios",
                "Retiro",
                "Rionegro",
                "Sabanalarga",
                "Sabaneta",
                "Salgar",
                "San Andrés de Cuerquía",
                "San Carlos",
                "San Francisco",
                "San Jerónimo",
                "San José de la Montaña",
                "San Juan de Urabá",
                "San Luis",
                "San Pedro de los Milagros",
                "San Pedro de Urabá",
                "San Rafael",
                "San Roque",
                "San Vicente",
                "Santa Bárbara",
                "Santa Fé de Antioquia",
                "Santa Rosa de Osos",
                "Santo Domingo",
                "El Santuario",
                "Segovia",
                "Sonsón",
                "Sopetrán",
                "Támesis",
                "Tarazá",
                "Tarso",
                "Titiribí",
                "Toledo",
                "Turbo",
                "Uramita",
                "Urrao",
                "Valdivia",
                "Valparaíso",
                "Vegachí",
                "Venecia",
                "Vigía del Fuerte",
                "Yalí",
                "Yarumal",
                "Yolombó",
                "Yondó",
                "Zaragoza"
            ],
            'Arauca' => [
                'Arauca',
                'Arauquita',
                'Cravo Norte',
                'Fortul',
                'Puerto Rondón',
                'Saravena',
                'Tame'
            ],
            'Atlántico' => [
                'Baranoa',
                'Barranquilla',
                'Campo de la Cruz',
                'Candelaria',
                'Galapa',
                'Juan de Acosta',
                'Luruaco',
                'Malambo',
                'Manatí',
                'Palmar de Varela',
                'Piojó',
                'Polonuevo',
                'Ponedera',
                'Puerto Colombia',
                'Repelón',
                'Sabanagrande',
                'Sabanalarga',
                'Santa Lucía',
                'Santo Tomás',
                'Soledad',
                'Suan',
                'Tubará',
                'Usiacurí'
            ],
            'Bolívar' => [
                'Cartagena de Indias',
                'Achí',
                'Altos del Rosario',
                'Arenal',
                'Arjona',
                'Arroyohondo',
                'Barranco de Loba',
                'Calamar',
                'Cantagallo',
                'Cicuco',
                'Clemencia',
                'Córdoba',
                'El Carmen de Bolívar',
                'El Guamo',
                'El Peñón',
                'Hatillo de Loba',
                'Magangué',
                'Mahates',
                'Margarita',
                'María la Baja',
                'Mompós',
                'Montecristo',
                'Morales',
                'Norosí',
                'Pinillos',
                'Regidor',
                'Río Viejo',
                'San Cristóbal',
                'San Estanislao',
                'San Fernando',
                'San Jacinto',
                'San Jacinto del Cauca',
                'San Juan Nepomuceno',
                'San Martín de Loba',
                'San Pablo',
                'Santa Catalina',
                'Santa Rosa',
                'Santa Rosa del Sur',
                'Simití',
                'Soplaviento',
                'Talaigua Nuevo',
                'Tiquisio',
                'Turbaco',
                'Turbaná',
                'Villanueva',
                'Zambrano'
            ],
            'Boyacá' => [
                'Tunja',
                'Almeida',
                'Aquitania',
                'Arcabuco',
                'Belén',
                'Berbeo',
                'Betéitiva',
                'Boavita',
                'Boyacá',
                'Briceño',
                'Buena Vista',
                'Busbanzá',
                'Caldas',
                'Campohermoso',
                'Cerinza',
                'Chinavita',
                'Chiquinquirá',
                'Chíquiza',
                'Chiscas',
                'Chita',
                'Chitaraque',
                'Chivatá',
                'Chivor',
                'Ciénega',
                'Cómbita',
                'Coper',
                'Corrales',
                'Covarachía',
                'Cubará',
                'Cucaita',
                'Cuitiva',
                'Duitama',
                'El Cocuy',
                'El Espino',
                'Firavitoba',
                'Floresta',
                'Gachantivá',
                'Gámeza',
                'Garagoa',
                'Guacamayas',
                'Guateque',
                'Guayatá',
                'Güicán',
                'Iza',
                'Jenesano',
                'Jericó',
                'La Capilla',
                'La Uvita',
                'La Victoria',
                'Labranzagrande',
                'Macanal',
                'Maripí',
                'Miraflores',
                'Mongua',
                'Monguí',
                'Moniquirá',
                'Motavita',
                'Muzo',
                'Nobsa',
                'Nuevo Colón',
                'Oicatá',
                'Otanche',
                'Pachavita',
                'Páez',
                'Paipa',
                'Pajarito',
                'Panqueba',
                'Pauna',
                'Paya',
                'Paz de Río',
                'Pesca',
                'Pisba',
                'Puerto Boyacá',
                'Quípama',
                'Ramiriquí',
                'Ráquira',
                'Rondón',
                'Saboyá',
                'Sáchica',
                'Samacá',
                'San Eduardo',
                'San José de Pare',
                'San Luis de Gaceno',
                'San Mateo',
                'San Miguel de Sema',
                'San Pablo de Borbur',
                'Santa María',
                'Santa Rosa de Viterbo',
                'Santa Sofía',
                'Santana',
                'Sativanorte',
                'Sativasur',
                'Siachoque',
                'Soatá',
                'Socotá',
                'Sogamoso',
                'Somondoco',
                'Sora',
                'Soracá',
                'Sotaquirá',
                'Susacón',
                'Sutamarchán',
                'Sutatenza',
                'Tasco',
                'Tenza',
                'Tibaná',
                'Tinjacá',
                'Tipacoque',
                'Toca',
                'Togüí',
                'Tópaga',
                'Tota',
                'Tununguá',
                'Turmequé',
                'Tuta',
                'Tutazá',
                'Úmbita',
                'Ventaquemada',
                'Villa de Leyva',
                'Viracachá',
                'Zetaquira'
            ],
            'Caldas' => [
                'Manizales',
                'Aguadas',
                'Anserma',
                'Aranzazu',
                'Belalcázar',
                'Chinchiná',
                'Filadelfia',
                'La Dorada',
                'La Merced',
                'Manzanares',
                'Marmato',
                'Marquetalia',
                'Marulanda',
                'Neira',
                'Norcasia',
                'Pácora',
                'Palestina',
                'Pensilvania',
                'Riosucio',
                'Risaralda',
                'Salamina',
                'Samaná',
                'San José',
                'Supía',
                'Victoria',
                'Villamaría',
                'Viterbo'
            ],
            'Caquetá' => [
                "Albania",
                "Belén de los Andaquíes",
                "Cartagena del Chairá",
                "Curillo",
                "El Doncello",
                "El Paujil",
                "Florencia",
                "La Montañita",
                "Milán",
                "Morelia",
                "Puerto Rico",
                "San José del Fragua",
                "San Vicente del Caguán",
                "Solano",
                "Solita",
                "Valparaíso"
            ],
            'Casanare' => [
                "Aguazul",
                "Chámeza",
                "Hato Corozal",
                "La Salina",
                "Maní",
                "Monterrey",
                "Nunchía",
                "Orocué",
                "Paz de Ariporo",
                "Pore",
                "Recetor",
                "Sabanalarga",
                "Sácama",
                "San Luis de Palenque",
                "Támara",
                "Tauramena",
                "Trinidad",
                "Villanueva",
                "Yopal"
            ],
            'Cauca' => [
                "Almaguer",
                "Argelia",
                "Balboa",
                "Bolívar",
                "Buenos Aires",
                "Cajibío",
                "Caldono",
                "Caloto",
                "Corinto",
                "El Tambo",
                "Florencia",
                "Guachené",
                "Guapí",
                "Inzá",
                "Jambaló",
                "La Sierra",
                "La Vega",
                "López de Micay",
                "Mercaderes",
                "Miranda",
                "Morales",
                "Padilla",
                "Páez",
                "Patía",
                "Piamonte",
                "Piendamó",
                "Popayán",
                "Puerto Tejada",
                "Puracé",
                "Rosas",
                "San Sebastián",
                "Santander de Quilichao",
                "Santa Rosa",
                "Silvia",
                "Sotará",
                "Suárez",
                "Sucre",
                "Timbío",
                "Timbiquí",
                "Toribío",
                "Totoró",
                "Villa Rica"
            ],
            'Cesar' => [
                "Aguachica",
                "Agustín Codazzi",
                "Astrea",
                "Becerril",
                "Bosconia",
                "Chimichagua",
                "Chiriguaná",
                "Curumaní",
                "El Copey",
                "El Paso",
                "Gamarra",
                "González",
                "La Gloria",
                "La Jagua de Ibirico",
                "La Paz",
                "Manaure Balcón del Cesar",
                "Pailitas",
                "Pelaya",
                "Pueblo Bello",
                "Río de Oro",
                "Robles La Paz",
                "San Alberto",
                "San Diego",
                "San Martín",
                "Tamalameque"
            ],
            'Chocó' => [
                "Acandí",
                "Alto Baudó",
                "Bagadó",
                "Bahía Solano",
                "Bajo Baudó",
                "Bojayá",
                "Cantón de San Pablo",
                "Cértegui",
                "Condoto",
                "El Atrato",
                "El Carmen de Atrato",
                "El Carmen del Darién",
                "Istmina",
                "Juradó",
                "Lloró",
                "Medio Atrato",
                "Medio Baudó",
                "Medio San Juan",
                "Nóvita",
                "Nuquí",
                "Quibdó",
                "Río Iró",
                "Río Quito",
                "Riosucio",
                "San José del Palmar",
                "Sipí",
                "Tadó",
                "Unguía",
                "Unión Panamericana"
            ],
            'Córdoba' => [
                "Ayapel",
                "Buenavista",
                "Canalete",
                "Cereté",
                "Chimá",
                "Chinú",
                "Ciénaga de Oro",
                "Cotorra",
                "La Apartada",
                "Lorica",
                "Los Córdobas",
                "Momil",
                "Moñitos",
                "Montelíbano",
                "Montería",
                "Planeta Rica",
                "Pueblo Nuevo",
                "Puerto Escondido",
                "Puerto Libertador",
                "Purísima",
                "Sahagún",
                "San Andrés de Sotavento",
                "San Antero",
                "San Bernardo del Viento",
                "San Carlos",
                "San José de Uré",
                "San Pelayo",
                "Tierralta",
                "Tuchín",
                "Valencia"
            ],
            'Cundinamarca' => [
                'Bogotá, D.C.',
                'Agua de Dios',
                'Albán',
                'Anapoima',
                'Anolaima',
                'Apulo',
                'Arbeláez',
                'Beltrán',
                'Bituima',
                'Bojacá',
                'Cabrera',
                'Cachipay',
                'Cajicá',
                'Caparrapí',
                'Cáqueza',
                'Carmen de Carupa',
                'Chaguaní',
                'Chía',
                'Chipaque',
                'Choachí',
                'Chocontá',
                'Cogua',
                'Cota',
                'Cucunubá',
                'El Colegio',
                'El Peñón',
                'El Rosal',
                'Facatativá',
                'Fomeque',
                'Fosca',
                'Funza',
                'Fúquene',
                'Fusagasugá',
                'Gachalá',
                'Gachancipá',
                'Gachetá',
                'Gama',
                'Girardot',
                'Granada',
                'Guachetá',
                'Guaduas',
                'Guasca',
                'Guataquí',
                'Guatavita',
                'Guayabal de Síquima',
                'Guayabetal',
                'Gutiérrez',
                'Jerusalén',
                'Junín',
                'La Calera',
                'La Mesa',
                'La Palma',
                'La Peña',
                'La Vega',
                'Lenguazaque',
                'Machetá',
                'Madrid',
                'Manta',
                'Medina',
                'Mosquera',
                'Nariño',
                'Nemocón',
                'Nilo',
                'Nimaima',
                'Nocaima',
                'Pacho',
                'Paime',
                'Pandi',
                'Paratebueno',
                'Pasca',
                'Puerto Salgar',
                'Pulí',
                'Quebradanegra',
                'Quetame',
                'Quipile',
                'Ricaurte',
                'San Antonio del Tequendama',
                'San Bernardo',
                'San Cayetano',
                'San Francisco',
                'San Juan de Río Seco',
                'Sasaima',
                'Sesquilé',
                'Sibaté',
                'Silvania',
                'Simijaca',
                'Soacha',
                'Sopó',
                'Subachoque',
                'Suesca',
                'Supatá',
                'Susa',
                'Sutatausa',
                'Tabio',
                'Tausa',
                'Tena',
                'Tenjo',
                'Tibacuy',
                'Tibirita',
                'Tocaima',
                'Tocancipá',
                'Topaipí',
                'Ubalá',
                'Ubaque',
                'Ubaté',
                'Une',
                'Útica',
                'Venecia',
                'Vergara',
                'Vianí',
                'Villagómez',
                'Villapinzón',
                'Villeta',
                'Viotá',
                'Yacopí',
                'Zipacón',
                'Zipaquirá'
            ],
            'Guainía' => [
                'Inírida',
                'Barranco Minas',
                'Cacahual',
                'La Guadalupe',
                'Mapiripana',
                'Morichal',
                'Pana Pana',
                'Puerto Colombia',
                'San Felipe'
            ],
            'Guaviare' => [
                'San José del Guaviare',
                'Calamar',
                'El Retorno',
                'Miraflores'
            ],
            'Huila' => [
                'Neiva',
                'Acevedo',
                'Agrado',
                'Aipe',
                'Algeciras',
                'Altamira',
                'Baraya',
                'Campoalegre',
                'Colombia',
                'Elias',
                'Garzón',
                'Gigante',
                'Guadalupe',
                'Hobo',
                'Iquira',
                'Isnos',
                'La Argentina',
                'La Plata',
                'Nátaga',
                'Oporapa',
                'Paicol',
                'Palermo',
                'Palestina',
                'Pital',
                'Pitalito',
                'Rivera',
                'Saladoblanco',
                'San Agustín',
                'Santa María',
                'Suaza',
                'Tarqui',
                'Tello',
                'Teruel',
                'Tesalia',
                'Timaná',
                'Villavieja',
                'Yaguará'
            ],
            'La Guajira' => [
                'Riohacha',
                'Albania',
                'Barrancas',
                'Dibulla',
                'Distracción',
                'El Molino',
                'Fonseca',
                'Hatonuevo',
                'La Jagua del Pilar',
                'Maicao',
                'Manaure',
                'San Juan del Cesar',
                'Uribia',
                'Urumita',
                'Villanueva'
            ],
            'Magdalena' => [
                'Santa Marta',
                'Algarrobo',
                'Aracataca',
                'Ariguaní',
                'Cerro de San Antonio',
                'Chibolo',
                'Ciénaga',
                'El Banco',
                'El Piñón',
                'El Retén',
                'Fundación',
                'Guamal',
                'Nueva Granada',
                'Pedraza',
                'Pijiño del Carmen',
                'Pivijay',
                'Plato',
                'Puebloviejo',
                'Remolino',
                'Sabanas de San Ángel',
                'Salamina',
                'San Sebastián de Buenavista',
                'San Zenón',
                'Santa Ana',
                'Sitionuevo',
                'Tenerife',
                'Zapayán',
                'Zona Bananera'
            ],
            'Meta' => [
                'Villavicencio',
                'Acacías',
                'Barranca de Upía',
                'Cabuyaro',
                'Castilla la Nueva',
                'Cubarral',
                'Cumaral',
                'El Calvario',
                'El Castillo',
                'El Dorado',
                'Fuente de Oro',
                'Granada',
                'Guamal',
                'La Macarena',
                'Lejanías',
                'Mapiripán',
                'Mesetas',
                'Puerto Concordia',
                'Puerto Gaitán',
                'Puerto Lleras',
                'Puerto López',
                'Puerto Rico',
                'Restrepo',
                'San Carlos de Guaroa',
                'San Juan de Arama',
                'San Juanito',
                'San Martín',
                'Uribe',
                'Vista Hermosa'
            ],
            'Nariño' => [
                'Pasto',
                'Albán',
                'Aldana',
                'Ancuyá',
                'Arboleda',
                'Barbacoas',
                'Belén',
                'Buesaco',
                'Chachagüí',
                'Colón',
                'Consacá',
                'Contadero',
                'Córdoba',
                'Cuaspud',
                'Cumbal',
                'Cumbitara',
                'El Charco',
                'El Peñol',
                'El Rosario',
                'El Tablón de Gómez',
                'El Tambo',
                'Francisco Pizarro',
                'Funes',
                'Guachucal',
                'Guaitarilla',
                'Gualmatán',
                'Iles',
                'Imués',
                'Ipiales',
                'La Cruz',
                'La Florida',
                'La Llanada',
                'La Tola',
                'La Unión',
                'Leiva',
                'Linares',
                'Los Andes',
                'Magüí Payán',
                'Mallama',
                'Mosquera',
                'Nariño',
                'Olaya Herrera',
                'Ospina',
                'Policarpa',
                'Potosí',
                'Providencia',
                'Puerres',
                'Pupiales',
                'Ricaurte',
                'Roberto Payán',
                'Samaniego',
                'San Bernardo',
                'San Lorenzo',
                'San Pablo',
                'San Pedro de Cartago',
                'Sandoná',
                'Santa Bárbara',
                'Santacruz',
                'Sapuyes',
                'Taminango',
                'Tangua',
                'Tumaco',
                'Túquerres',
                'Yacuanquer'
            ],
            'Norte de Santander' => [
                'Cúcuta',
                'Ábrego',
                'Arboledas',
                'Bochalema',
                'Bucarasica',
                'Cácota',
                'Cachirá',
                'Chinácota',
                'Chitagá',
                'Convención',
                'Cucutilla',
                'Durania',
                'El Carmen',
                'El Tarra',
                'El Zulia',
                'Gramalote',
                'Hacarí',
                'Herrán',
                'La Esperanza',
                'La Playa',
                'Labateca',
                'Los Patios',
                'Lourdes',
                'Mutiscua',
                'Ocaña',
                'Pamplona',
                'Pamplonita',
                'Puerto Santander',
                'Ragonvalia',
                'Salazar de Las Palmas',
                'San Calixto',
                'San Cayetano',
                'Santiago',
                'Santo Domingo de Silos',
                'Sardinata',
                'Teorama',
                'Tibú',
                'Toledo',
                'Villa Caro',
                'Villa del Rosario'
            ],
            'Putumayo' => [
                'Mocoa',
                'Colón',
                'Orito',
                'Puerto Asís',
                'Puerto Caicedo',
                'Puerto Guzmán',
                'Leguízamo',
                'Sibundoy',
                'San Francisco',
                'San Miguel',
                'Santiago',
                'Valle del Guamuez',
                'Villagarzón'
            ],
            'Quindío' => [
                'Armenia',
                'Buenavista',
                'Calarcá',
                'Circasia',
                'Córdoba',
                'Filandia',
                'Génova',
                'La Tebaida',
                'Montenegro',
                'Pijao',
                'Quimbaya',
                'Salento'
            ],
            'Risaralda' => [
                'Pereira',
                'Apía',
                'Balboa',
                'Belén de Umbría',
                'Dosquebradas',
                'Guática',
                'La Celia',
                'La Virginia',
                'Marsella',
                'Mistrató',
                'Pueblo Rico',
                'Quinchía',
                'Santa Rosa de Cabal',
                'Santuario'
            ],
            'San Andrés y Providencia' => [
                'San Andrés',
                'Providencia y Santa Catalina'
            ],
            'Santander' => [
                'Bucaramanga',
                'Aguada',
                'Albania',
                'Aratoca',
                'Barbosa',
                'Barichara',
                'Barrancabermeja',
                'Betulia',
                'Bolívar',
                'Cabrera',
                'California',
                'Capitanejo',
                'Carcasí',
                'Cepitá',
                'Cerrito',
                'Charalá',
                'Charta',
                'Chima',
                'Chipatá',
                'Cimitarra',
                'Concepción',
                'Confines',
                'Contratación',
                'Coromoro',
                'Curití',
                'El Carmen de Chucurí',
                'El Guacamayo',
                'El Peñón',
                'El Playón',
                'Encino',
                'Enciso',
                'Floridablanca',
                'Florián',
                'Galán',
                'Gámbita',
                'Girón',
                'Guaca',
                'Guadalupe',
                'Guapotá',
                'Guavatá',
                'Güepsa',
                'Hato',
                'Jesús María',
                'Jordán',
                'La Belleza',
                'La Paz',
                'Landázuri',
                'Lebrija',
                'Los Santos',
                'Macaravita',
                'Málaga',
                'Matanza',
                'Mogotes',
                'Molagavita',
                'Ocamonte',
                'Oiba',
                'Onzaga',
                'Palmar',
                'Palmas del Socorro',
                'Páramo',
                'Piedecuesta',
                'Pinchote',
                'Puente Nacional',
                'Puerto Parra',
                'Puerto Wilches',
                'Rionegro',
                'Sabana de Torres',
                'San Andrés',
                'San Benito',
                'San Gil',
                'San Joaquín',
                'San José de Miranda',
                'San Miguel',
                'San Vicente de Chucurí',
                'Santa Bárbara',
                'Santa Helena del Opón',
                'Simacota',
                'Socorro',
                'Suaita',
                'Sucre',
                'Suratá',
                'Tona',
                'Valle de San José',
                'Vélez',
                'Vetas',
                'Villanueva',
                'Zapatoca'
            ],
            'Sucre' => [
                'Sincelejo',
                'Buenavista',
                'Caimito',
                'Colosó',
                'Coveñas',
                'Chalán',
                'El Roble',
                'Galeras',
                'Guaranda',
                'La Unión',
                'Los Palmitos',
                'Majagual',
                'Morroa',
                'Ovejas',
                'Palmito',
                'Sampués',
                'San Benito Abad',
                'San Juan de Betulia',
                'San Marcos',
                'San Onofre',
                'San Pedro',
                'San Luis de Sincé',
                'Sucre',
                'Santiago de Tolú',
                'Tolú Viejo'
            ],
            'Tolima' => [
                'Ibagué',
                'Alpujarra',
                'Alvarado',
                'Ambalema',
                'Anzoátegui',
                'Armero',
                'Ataco',
                'Cajamarca',
                'Carmen de Apicalá',
                'Casabianca',
                'Chaparral',
                'Coello',
                'Coyaima',
                'Cunday',
                'Dolores',
                'Espinal',
                'Falan',
                'Flandes',
                'Fresno',
                'Guamo',
                'Herveo',
                'Honda',
                'Icononzo',
                'Lérida',
                'Líbano',
                'Mariquita',
                'Melgar',
                'Murillo',
                'Natagaima',
                'Ortega',
                'Palocabildo',
                'Piedras',
                'Planadas',
                'Prado',
                'Purificación',
                'Rioblanco',
                'Roncesvalles',
                'Rovira',
                'Saldaña',
                'San Antonio',
                'San Luis',
                'Santa Isabel',
                'Suárez',
                'Valle de San Juan',
                'Venadillo',
                'Villahermosa',
                'Villarrica'
            ],
            'Valle del Cauca' => [
                'Cali',
                'Alcalá',
                'Andalucía',
                'Ansermanuevo',
                'Argelia',
                'Bolívar',
                'Buenaventura',
                'Bugalagrande',
                'Caicedonia',
                'Calima (Darién)',
                'Candelaria',
                'Cartago',
                'Dagua',
                'El Águila',
                'El Cairo',
                'El Cerrito',
                'El Dovio',
                'Florida',
                'Ginebra',
                'Guacarí',
                'Jamundí',
                'La Cumbre',
                'La Unión',
                'La Victoria',
                'Obando',
                'Palmira',
                'Pradera',
                'Restrepo',
                'Riofrío',
                'Roldanillo',
                'San Pedro',
                'Sevilla',
                'Toro',
                'Trujillo',
                'Tuluá',
                'Ulloa',
                'Versalles',
                'Vijes',
                'Yotoco',
                'Yumbo',
                'Zarzal'
            ],
            'Vaupés' => [
                'Mitú',
                'Caruru',
                'Pacoa',
                'Taraira',
                'Papunaua',
                'Yavaraté',
                'Tatamá'
            ],
            'Vichada' => [
                'Puerto Carreño',
                'La Primavera',
                'Santa Rosalía',
                'Cumaribo'
            ],
        ];
        // Retorna la vista de la lista de proveedores, usando compact para enviar los datos a la vista
        return view('livewire.admin.providers', compact('name', 'proveedor', 'departamentos', 'group'));
    }
}
