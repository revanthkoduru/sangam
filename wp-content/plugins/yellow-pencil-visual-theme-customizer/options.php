<?php
	
/* ---------------------------------------------------- */
/* All CSS Options and settings							*/
/* ---------------------------------------------------- */
echo "<ul class='yp-editor-list'>
		
		<li class='yp-li-about active'>
			<h3><small>".__('You are customizing','yp')."</small> <div>".yp_customizer_name()."</div></h3>
		</li>
		
		<li class='text-option'>
			<h3>".__('Text','yp')." ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>
			
				".yp_get_select_markup(
					'font-family',
					__('Font Family','yp')
					,array(
					
						// Safe Fonts.
						"Georgia, serif" => "Georgia",
						"Helvetica Neue" => "Helvetica Neue",
						"'Times New Roman', Times, serif" => "Times New Roman",
						"Arial, Helvetica, sans-serif" => "Arial",
						"'Arial Black', Gadget, sans-serif" => "Arial Black",
						"Impact, Charcoal, sans-serif" => "Impact",
						"Tahoma, Geneva, sans-serif" => "Tahoma",
						"Verdana, Geneva, sans-serif" => "Verdana",
						
						// Google fonts.
						"'Open Sans', sans-serif" => "Open Sans",
						"'Roboto', sans-serif" => "Roboto",
						"'Lato', sans-serif" => "Lato",
						"'Oswald', sans-serif" => "Oswald",
						"'Slabo 27px', serif" => "Slabo 27px",
						"'Roboto Condensed', sans-serif" => "Roboto Condensed",
						"'Source Sans Pro', sans-serif" => "Source Sans Pro",
						"'Lora', serif" => "Lora",
						"'Montserrat', sans-serif" => "Montserrat",
						"'PT Sans', sans-serif" => "PT Sans",
						"'Raleway', sans-serif" => "Raleway",
						"'Open Sans Condensed', sans-serif" => "Open Sans Condensed",
						"'Droid Sans', sans-serif" => "Droid Sans",
						"'Ubuntu', sans-serif" => "Ubuntu",
						"'Roboto Slab', serif" => "Roboto Slab",
						"'Droid Serif', serif" => "Droid Serif",
						"'Merriweather', serif" => "Merriweather",
						"'Arimo', sans-serif" => "Arimo",
						"'PT Sans Narrow', sans-serif" => "PT Sans Narrow",
						"'Noto Sans', sans-serif" => "Noto Sans",
						"'Titillium Web', sans-serif" => "Titillium Web",
						"'PT Serif', serif" => "PT Serif",
						"'Bitter', serif" => "Bitter",
						"'Yanone Kaffeesatz', sans-serif" => "Yanone Kaffeesatz",
						"'Indie Flower', handwriting" => "Indie Flower",
						"'Playfair Display', serif" => "Playfair Display",
						"'Arvo', serif" => "Arvo",
						"'Dosis', sans-serif" => "Dosis",
						"'Cabin', sans-serif" => "Cabin",
						"'Lobster', display" => "Lobster",
						"'Oxygen', sans-serif" => "Oxygen",
						"'Fjalla One', sans-serif" => "Fjalla One",
						"'Poiret One', display" => "Poiret One",
						"'Noto Serif', serif" => "Noto Serif",
						"'Nunito', sans-serif" => "Nunito",
						"'Hind', sans-serif" => "Hind",
						"'Inconsolata', monospace" => "Inconsolata",
						"'Muli', sans-serif" => "Muli",
						"'Bree Serif', serif" => "Bree Serif",
						"'Abel', sans-serif" => "Abel",
						"'Archivo Narrow', sans-serif" => "Archivo Narrow",
						"'Vollkorn', serif" => "Vollkorn",
						"'Signika', sans-serif" => "Signika",
						"'Josefin Sans', sans-serif" => "Josefin Sans",
						"'Libre Baskerville', serif" => "Libre Baskerville",
						"'Play', sans-serif" => "Play",
						"'Fira Sans', sans-serif" => "Fira Sans",
						"'Ubuntu Condensed', sans-serif" => "Ubuntu Condensed",
						"'Anton', sans-serif" => "Anton",
						"'Orbitron', sans-serif" => "Orbitron",
						"'Francois One', sans-serif" => "Francois One",
						"'Shadows Into Light', handwriting" => "Shadows Into Light",
						"'Asap', sans-serif" => "Asap",
						"'Alegreya', serif" => "Alegreya",
						"'Cuprum', sans-serif" => "Cuprum",
						"'Maven Pro', sans-serif" => "Maven Pro",
						"'Pacifico', handwriting" => "Pacifico",
						"'Exo 2', sans-serif" => "Exo 2",
						"'Varela Round', sans-serif" => "Varela Round",
						"'Crimson Text', serif" => "Crimson Text",
						"'Merriweather Sans', sans-serif" => "Merriweather Sans",
						"'Karla', sans-serif" => "Karla",
						"'Quicksand', sans-serif" => "Quicksand",
						"'Rokkitt', serif" => "Rokkitt",
						"'PT Sans Caption', sans-serif" => "PT Sans Caption",
						"'Architects Daughter', handwriting" => "Architects Daughter",
						"'Amatic SC', handwriting" => "Amatic SC",
						"'Dancing Script', handwriting" => "Dancing Script",
						"'Exo', sans-serif" => "Exo",
						"'Patua One', display" => "Patua One",
						"'Sigmar One', display" => "Sigmar One",
						"'Questrial', sans-serif" => "Questrial",
						"'Pathway Gothic One', sans-serif" => "Pathway Gothic One",
						"'Monda', sans-serif" => "Monda",
						"'BenchNine', sans-serif" => "BenchNine",
						"'Abril Fatface', display" => "Abril Fatface",
						"'Righteous', display" => "Righteous",
						"'Istok Web', sans-serif" => "Istok Web",
						"'Sanchez', serif" => "Sanchez",
						"'Gudea', sans-serif" => "Gudea",
						"'Source Code Pro', monospace" => "Source Code Pro",
						"'Josefin Slab', serif" => "Josefin Slab",
						"'Ropa Sans', sans-serif" => "Ropa Sans",
						"'Gloria Hallelujah', handwriting" => "Gloria Hallelujah",
						"'Crete Round', serif" => "Crete Round",
						"'Noticia Text', serif" => "Noticia Text",
						"'Pontano Sans', sans-serif" => "Pontano Sans",
						"'Quattrocento Sans', sans-serif" => "Quattrocento Sans",
						"'Kaushan Script', handwriting" => "Kaushan Script",
						"'Armata', sans-serif" => "Armata",
						"'EB Garamond', serif" => "EB Garamond",
						"'Voltaire', sans-serif" => "Voltaire",
						"'Chewy', display" => "Chewy",
						"'Cabin Condensed', sans-serif" => "Cabin Condensed",
						"'News Cycle', sans-serif" => "News Cycle",
						"'Bangers', display" => "Bangers",
						"'Hammersmith One', sans-serif" => "Hammersmith One",
						"'Chivo', sans-serif" => "Chivo",
						"'Passion One', display" => "Passion One",
						"'Comfortaa', display" => "Comfortaa",
						"'Cantarell', sans-serif" => "Cantarell",
						"'Covered By Your Grace', handwriting" => "Covered By Your Grace",
						"'ABeeZee', sans-serif" => "ABeeZee",
						"'Russo One', sans-serif" => "Russo One",
						"'Old Standard TT', serif" => "Old Standard TT",
						"'Archivo Black', sans-serif" => "Archivo Black",
						"'Lobster Two', display" => "Lobster Two",
						"'Gochi Hand', handwriting" => "Gochi Hand",
						"'Coming Soon', handwriting" => "Coming Soon",
						"'Tinos', serif" => "Tinos",
						"'Courgette', handwriting" => "Courgette",
						"'Permanent Marker', handwriting" => "Permanent Marker",
						"'Shadows Into Light Two', handwriting" => "Shadows Into Light Two",
						"'Fredoka One', display" => "Fredoka One",
						"'Satisfy', handwriting" => "Satisfy",
						"'Philosopher', sans-serif" => "Philosopher",
						"'Alfa Slab One', display" => "Alfa Slab One",
						"'Ruda', sans-serif" => "Ruda",
						"'Cinzel', serif" => "Cinzel",
						"'Vidaloka', serif" => "Vidaloka",
						"'Changa One', display" => "Changa One",
						"'Andada', serif" => "Andada",
						"'Didact Gothic', sans-serif" => "Didact Gothic",
						"'Quattrocento', serif" => "Quattrocento",
						"'Kreon', serif" => "Kreon",
						"'Varela', sans-serif" => "Varela",
						"'Alegreya Sans', sans-serif" => "Alegreya Sans",
						"'Domine', serif" => "Domine",
						"'Economica', sans-serif" => "Economica",
						"'Handlee', handwriting" => "Handlee",
						"'Pinyon Script', handwriting" => "Pinyon Script",
						"'Bevan', display" => "Bevan",
						"'Rock Salt', handwriting" => "Rock Salt",
						"'Playfair Display SC', serif" => "Playfair Display SC",
						"'Cardo', serif" => "Cardo",
						"'Sintony', sans-serif" => "Sintony",
						"'Antic Slab', serif" => "Antic Slab",
						"'Playball', display" => "Playball",
						"'Marcellus', serif" => "Marcellus",
						"'Nobile', sans-serif" => "Nobile",
						"'Cookie', handwriting" => "Cookie",
						"'Droid Sans Mono', monospace" => "Droid Sans Mono",
						"'Gentium Book Basic', serif" => "Gentium Book Basic",
						"'Actor', sans-serif" => "Actor",
						"'Tangerine', handwriting" => "Tangerine",
						"'Jura', sans-serif" => "Jura",
						"'Amaranth', sans-serif" => "Amaranth",
						"'Paytone One', sans-serif" => "Paytone One",
						"'Special Elite', display" => "Special Elite",
						"'Great Vibes', handwriting" => "Great Vibes",
						"'Rambla', sans-serif" => "Rambla",
						"'Molengo', sans-serif" => "Molengo",
						"'Neuton', serif" => "Neuton",
						"'Trocchi', serif" => "Trocchi",
						"'Fauna One', serif" => "Fauna One",
						"'Signika Negative', sans-serif" => "Signika Negative",
						"'Scada', sans-serif" => "Scada",
						"'Bad Script', handwriting" => "Bad Script",
						"'Luckiest Guy', display" => "Luckiest Guy",
						"'Enriqueta', serif" => "Enriqueta",
						"'Rajdhani', sans-serif" => "Rajdhani",
						"'Marck Script', handwriting" => "Marck Script",
						"'Squada One', display" => "Squada One",
						"'Patrick Hand', handwriting" => "Patrick Hand",
						"'Fugaz One', display" => "Fugaz One",
						"'Sorts Mill Goudy', serif" => "Sorts Mill Goudy",
						"'Marvel', sans-serif" => "Marvel",
						"'Glegoo', serif" => "Glegoo",
						"'Oleo Script', display" => "Oleo Script",
						"'Waiting for the Sunrise', handwriting" => "Waiting for the Sunrise",
						"'Days One', sans-serif" => "Days One",
						"'Marmelad', sans-serif" => "Marmelad",
						"'Damion', handwriting" => "Damion",
						"'Viga', sans-serif" => "Viga",
						"'Contrail One', display" => "Contrail One",
						"'Volkhov', serif" => "Volkhov",
						"'Black Ops One', display" => "Black Ops One",
						"'Basic', sans-serif" => "Basic",
						"'Calligraffitti', handwriting" => "Calligraffitti",
						"'Audiowide', display" => "Audiowide",
						"'Arapey', serif" => "Arapey",
						"'Jockey One', sans-serif" => "Jockey One",
						"'Advent Pro', sans-serif" => "Advent Pro",
						"'Allerta', sans-serif" => "Allerta",
						"'Limelight', display" => "Limelight",
						"'Copse', serif" => "Copse",
						"'Convergence', sans-serif" => "Convergence",
						"'Carme', sans-serif" => "Carme",
						"'Amiri', serif" => "Amiri",
						"'Overlock', display" => "Overlock",
						"'Doppio One', sans-serif" => "Doppio One",
						"'Niconne', handwriting" => "Niconne",
						"'Lusitana', serif" => "Lusitana",
						"'Homemade Apple', handwriting" => "Homemade Apple",
						"'Julius Sans One', sans-serif" => "Julius Sans One",
						"'Nothing You Could Do', handwriting" => "Nothing You Could Do",
						"'Homenaje', sans-serif" => "Homenaje",
						"'Just Another Hand', handwriting" => "Just Another Hand",
						"'Boogaloo', display" => "Boogaloo",
						"'Electrolize', sans-serif" => "Electrolize",
						"'Roboto Mono', monospace" => "Roboto Mono",
						"'Antic', sans-serif" => "Antic",
						"'Nixie One', display" => "Nixie One",
						"'Walter Turncoat', handwriting" => "Walter Turncoat",
						"'Ultra', serif" => "Ultra",
						"'Syncopate', sans-serif" => "Syncopate",
						"'Average', serif" => "Average",
						"'Cutive', serif" => "Cutive",
						"'Sacramento', handwriting" => "Sacramento",
						"'Work Sans', sans-serif" => "Work Sans",
						"'Reenie Beanie', handwriting" => "Reenie Beanie",
						"'Bubblegum Sans', display" => "Bubblegum Sans",
						"'Cherry Cream Soda', display" => "Cherry Cream Soda",
						"'Kameron', serif" => "Kameron",
						"'Alegreya Sans SC', sans-serif" => "Alegreya Sans SC",
						"'Coda', display" => "Coda",
						"'Coustard', serif" => "Coustard",
						"'Neucha', handwriting" => "Neucha",
						"'Source Serif Pro', serif" => "Source Serif Pro",
						"'Gentium Basic', serif" => "Gentium Basic",
						"'Six Caps', sans-serif" => "Six Caps",
						"'Quantico', sans-serif" => "Quantico",
						"'Telex', sans-serif" => "Telex",
						"'Alice', serif" => "Alice",
						"'Fanwood Text', serif" => "Fanwood Text",
						"'Cantata One', serif" => "Cantata One",
						"'Montserrat Alternates', sans-serif" => "Montserrat Alternates",
						"'Podkova', serif" => "Podkova",
						"'VT323', monospace" => "VT323",
						"'Oranienbaum', serif" => "Oranienbaum",
						"'Crafty Girls', handwriting" => "Crafty Girls",
						"'Ubuntu Mono', monospace" => "Ubuntu Mono",
						"'Fontdiner Swanky', display" => "Fontdiner Swanky",
						"'Aldrich', sans-serif" => "Aldrich",
						"'Michroma', sans-serif" => "Michroma",
						"'Denk One', sans-serif" => "Denk One",
						"'Share', display" => "Share",
						"'Adamina', serif" => "Adamina",
						"'Rancho', handwriting" => "Rancho",
						"'Biryani', sans-serif" => "Biryani",
						"'PT Serif Caption', serif" => "PT Serif Caption",
						"'Allerta Stencil', sans-serif" => "Allerta Stencil",
						"'Acme', sans-serif" => "Acme",
						"'Ceviche One', display" => "Ceviche One",
						"'Berkshire Swash', handwriting" => "Berkshire Swash",
						"'Prata', serif" => "Prata",
						"'Carrois Gothic', sans-serif" => "Carrois Gothic",
						"'Ek Mukta', sans-serif" => "Ek Mukta",
						"'Fredericka the Great', display" => "Fredericka the Great",
						"'Rochester', handwriting" => "Rochester",
						"'Goudy Bookletter 1911', serif" => "Goudy Bookletter 1911",
						"'Cabin Sketch', display" => "Cabin Sketch",
						"'Radley', serif" => "Radley",
						"'Allura', handwriting" => "Allura",
						"'Alex Brush', handwriting" => "Alex Brush",
						"'Belleza', sans-serif" => "Belleza",
						"'Mallanna', sans-serif" => "Mallanna",
						"'Freckle Face', display" => "Freckle Face",
						"'Racing Sans One', display" => "Racing Sans One",
						"'Spinnaker', sans-serif" => "Spinnaker",
						"'Arbutus Slab', serif" => "Arbutus Slab",
						"'Mako', sans-serif" => "Mako",
						"'Yellowtail', handwriting" => "Yellowtail",
						"'IM Fell English', serif" => "IM Fell English",
						"'Rosario', sans-serif" => "Rosario",
						"'Aclonica', sans-serif" => "Aclonica",
						"'Annie Use Your Telescope', handwriting" => "Annie Use Your Telescope",
						"'Kalam', handwriting" => "Kalam",
						"'Lilita One', display" => "Lilita One",
						"'PT Mono', monospace" => "PT Mono",
						"'Schoolbell', handwriting" => "Schoolbell",
						"'Alegreya SC', serif" => "Alegreya SC",
						"'Candal', sans-serif" => "Candal",
						"'Magra', sans-serif" => "Magra",
						"'Puritan', sans-serif" => "Puritan",
						"'Alef', sans-serif" => "Alef",
						"'Khula', sans-serif" => "Khula",
						"'Inder', sans-serif" => "Inder",
						"'Frijole', display" => "Frijole",
						"'Average Sans', sans-serif" => "Average Sans",
						"'Lemon', display" => "Lemon",
						"'Marcellus SC', serif" => "Marcellus SC",
						"'Port Lligat Slab', serif" => "Port Lligat Slab",
						"'Lustria', serif" => "Lustria",
						"'Sansita One', display" => "Sansita One",
						"'Parisienne', handwriting" => "Parisienne",
						"'Metrophobic', sans-serif" => "Metrophobic",
						"'Forum', display" => "Forum",
						"'Chelsea Market', display" => "Chelsea Market",
						"'Gruppo', display" => "Gruppo",
						"'Cousine', monospace" => "Cousine",
						"'Megrim', display" => "Megrim",
						"'Duru Sans', sans-serif" => "Duru Sans",
						"'Carter One', display" => "Carter One",
						"'Tenor Sans', sans-serif" => "Tenor Sans",
						"'Press Start 2P', display" => "Press Start 2P",
						"'Londrina Solid', display" => "Londrina Solid",
						"'Grand Hotel', handwriting" => "Grand Hotel",
						"'Delius', handwriting" => "Delius",
						"'Capriola', sans-serif" => "Capriola",
						"'Tauri', sans-serif" => "Tauri",
						"'Unica One', display" => "Unica One",
						"'Voces', display" => "Voces",
						"'Allan', display" => "Allan",
						"'Montez', handwriting" => "Montez",
						"'Petit Formal Script', handwriting" => "Petit Formal Script",
						"'Englebert', sans-serif" => "Englebert",
						"'Italianno', handwriting" => "Italianno",
						"'Baumans', display" => "Baumans",
						"'Oxygen Mono', monospace" => "Oxygen Mono",
						"'Cinzel Decorative', display" => "Cinzel Decorative",
						"'Anaheim', sans-serif" => "Anaheim",
						"'Alike', serif" => "Alike",
						"'Cambay', sans-serif" => "Cambay",
						"'Slackey', display" => "Slackey",
						"'Crushed', display" => "Crushed",
						"'Bowlby One', display" => "Bowlby One",
						"'Gilda Display', serif" => "Gilda Display",
						"'Teko', sans-serif" => "Teko",
						"'Sue Ellen Francisco', handwriting" => "Sue Ellen Francisco",
						"'Caudex', serif" => "Caudex",
						"'UnifrakturMaguntia', display" => "UnifrakturMaguntia",
						"'Knewave', display" => "Knewave",
						"'Unkempt', display" => "Unkempt",
						"'Leckerli One', handwriting" => "Leckerli One",
						"'Finger Paint', display" => "Finger Paint",
						"'Love Ya Like A Sister', display" => "Love Ya Like A Sister",
						"'Corben', display" => "Corben",
						"'Kotta One', serif" => "Kotta One",
						"'The Girl Next Door', handwriting" => "The Girl Next Door",
						"'Imprima', sans-serif" => "Imprima",
						"'Brawler', serif" => "Brawler",
						"'Just Me Again Down Here', handwriting" => "Just Me Again Down Here",
						"'Yesteryear', handwriting" => "Yesteryear",
						"'Henny Penny', display" => "Henny Penny",
						"'Hanuman', serif" => "Hanuman",
						"'Kelly Slab', display" => "Kelly Slab",
						"'Fenix', serif" => "Fenix",
						"'Graduate', display" => "Graduate",
						"'Ovo', serif" => "Ovo",
						"'Strait', sans-serif" => "Strait",
						"'Lily Script One', display" => "Lily Script One",
						"'Judson', serif" => "Judson",
						"'Rufina', serif" => "Rufina",
						"'Give You Glory', handwriting" => "Give You Glory",
						"'Creepster', display" => "Creepster",
						"'Merienda One', handwriting" => "Merienda One",
						"'IM Fell DW Pica', serif" => "IM Fell DW Pica",
						"'Angkor', display" => "Angkor",
						"'Khand', sans-serif" => "Khand",
						"'Mr Dafoe', handwriting" => "Mr Dafoe",
						"'Sarala', sans-serif" => "Sarala",
						"'Andika', sans-serif" => "Andika",
						"'Slabo 13px', serif" => "Slabo 13px",
						"'Orienta', sans-serif" => "Orienta",
						"'Quando', serif" => "Quando",
						"'Merienda', handwriting" => "Merienda",
						"'Gravitas One', display" => "Gravitas One",
						"'Headland One', serif" => "Headland One",
						"'Belgrano', serif" => "Belgrano",
						"'Anonymous Pro', monospace" => "Anonymous Pro",
						"'Nova Square', display" => "Nova Square",
						"'Carrois Gothic SC', sans-serif" => "Carrois Gothic SC",
						"'Simonetta', display" => "Simonetta",
						"'Mr De Haviland', handwriting" => "Mr De Haviland",
						"'Bentham', serif" => "Bentham",
						"'GFS Didot', serif" => "GFS Didot",
						"'Lekton', sans-serif" => "Lekton",
						"'IM Fell English SC', serif" => "IM Fell English SC",
						"'Shanti', sans-serif" => "Shanti",
						"'Salsa', display" => "Salsa",
						"'Monoton', display" => "Monoton",
						"'Wire One', sans-serif" => "Wire One",
						"'Tienne', serif" => "Tienne",
						"'Fjord One', serif" => "Fjord One",
						"'Herr Von Muellerhoff', handwriting" => "Herr Von Muellerhoff",
						"'Seaweed Script', display" => "Seaweed Script",
						"'Kranky', display" => "Kranky",
						"'Pompiere', display" => "Pompiere",
						"'Skranji', display" => "Skranji",
						"'Qwigley', handwriting" => "Qwigley",
						"'La Belle Aurore', handwriting" => "La Belle Aurore",
						"'Poppins', sans-serif" => "Poppins",
						"'Short Stack', handwriting" => "Short Stack",
						"'Norican', handwriting" => "Norican",
						"'Lateef', handwriting" => "Lateef",
						"'Oregano', display" => "Oregano",
						"'Timmana', sans-serif" => "Timmana",
						"'Poly', serif" => "Poly",
						"'Unna', serif" => "Unna",
						"'Prosto One', display" => "Prosto One",
						"'Happy Monkey', display" => "Happy Monkey",
						"'Titan One', display" => "Titan One",
						"'Griffy', display" => "Griffy",
						"'Averia Sans Libre', display" => "Averia Sans Libre",
						"'Kristi', handwriting" => "Kristi",
						"'Patrick Hand SC', handwriting" => "Patrick Hand SC",
						"'Gafata', sans-serif" => "Gafata",
						"'Oleo Script Swash Caps', display" => "Oleo Script Swash Caps",
						"'Italiana', serif" => "Italiana",
						"'Mate', serif" => "Mate",
						"'Loved by the King', handwriting" => "Loved by the King",
						"'Bowlby One SC', display" => "Bowlby One SC",
						"'Stalemate', handwriting" => "Stalemate",
						"'Mountains of Christmas', display" => "Mountains of Christmas",
						"'Halant', serif" => "Halant",
						"'Mystery Quest', display" => "Mystery Quest",
						"'Khmer', display" => "Khmer",
						"'Federo', sans-serif" => "Federo",
						"'Ledger', serif" => "Ledger",
						"'Rationale', sans-serif" => "Rationale",
						"'Averia Gruesa Libre', display" => "Averia Gruesa Libre",
						"'Euphoria Script', handwriting" => "Euphoria Script",
						"'Arizonia', handwriting" => "Arizonia",
						"'Delius Swash Caps', handwriting" => "Delius Swash Caps",
						"'Trade Winds', display" => "Trade Winds",
						"'Martel', serif" => "Martel",
						"'Cambo', serif" => "Cambo",
						"'Rubik One', sans-serif" => "Rubik One",
						"'Clicker Script', handwriting" => "Clicker Script",
						"'Over the Rainbow', handwriting" => "Over the Rainbow",
						"'Nova Mono', monospace" => "Nova Mono",
						"'Share Tech', sans-serif" => "Share Tech",
						"'Expletus Sans', display" => "Expletus Sans",
						"'Codystar', display" => "Codystar",
						"'Mouse Memoirs', sans-serif" => "Mouse Memoirs",
						"'Sniglet', display" => "Sniglet",
						"'Cantora One', sans-serif" => "Cantora One",
						"'Bilbo Swash Caps', handwriting" => "Bilbo Swash Caps",
						"'Kite One', sans-serif" => "Kite One",
						"'Keania One', display" => "Keania One",
						"'Geo', sans-serif" => "Geo",
						"'Chau Philomene One', sans-serif" => "Chau Philomene One",
						"'Karma', serif" => "Karma",
						"'Mate SC', serif" => "Mate SC",
						"'Cutive Mono', monospace" => "Cutive Mono",
						"'Amethysta', serif" => "Amethysta",
						"'Meddon', handwriting" => "Meddon",
						"'Dawning of a New Day', handwriting" => "Dawning of a New Day",
						"'Shojumaru', display" => "Shojumaru",
						"'Yeseva One', display" => "Yeseva One",
						"'Kavoon', display" => "Kavoon",
						"'Vast Shadow', display" => "Vast Shadow",
						"'Oldenburg', display" => "Oldenburg",
						"'Buenard', serif" => "Buenard",
						"'Numans', sans-serif" => "Numans",
						"'Stardos Stencil', display" => "Stardos Stencil",
						"'Poller One', display" => "Poller One",
						"'Gabriela', serif" => "Gabriela",
						"'Life Savers', display" => "Life Savers",
						"'Zeyada', handwriting" => "Zeyada",
						"'Concert One', display" => "Concert One",
						"'Coda Caption', sans-serif" => "Coda Caption",
						"'Junge', serif" => "Junge",
						"'Balthazar', serif" => "Balthazar",
						"'Metamorphous', display" => "Metamorphous",
						"'Yantramanav', sans-serif" => "Yantramanav",
						"'Sofia', handwriting" => "Sofia",
						"'Engagement', handwriting" => "Engagement",
						"'Caesar Dressing', display" => "Caesar Dressing",
						"'Cherry Swash', display" => "Cherry Swash",
						"'Cedarville Cursive', handwriting" => "Cedarville Cursive",
						"'Flamenco', display" => "Flamenco",
						"'Raleway Dots', display" => "Raleway Dots",
						"'Ruslan Display', display" => "Ruslan Display",
						"'Medula One', display" => "Medula One",
						"'Vibur', handwriting" => "Vibur",
						"'Dorsa', sans-serif" => "Dorsa",
						"'Asul', sans-serif" => "Asul",
						"'Esteban', serif" => "Esteban",
						"'Share Tech Mono', monospace" => "Share Tech Mono",
						"'Rye', display" => "Rye",
						"'Maiden Orange', display" => "Maiden Orange",
						"'Holtwood One SC', serif" => "Holtwood One SC",
						"'Quintessential', handwriting" => "Quintessential",
						"'Amarante', display" => "Amarante",
						"'Stoke', serif" => "Stoke",
						"'Rosarivo', serif" => "Rosarivo",
						"'Aladin', handwriting" => "Aladin",
						"'IM Fell French Canon', serif" => "IM Fell French Canon",
						"'Monofett', display" => "Monofett",
						"'Fresca', sans-serif" => "Fresca",
						"'Donegal One', serif" => "Donegal One",
						"'Condiment', handwriting" => "Condiment",
						"'Swanky and Moo Moo', handwriting" => "Swanky and Moo Moo",
						"'IM Fell Double Pica', serif" => "IM Fell Double Pica",
						"'IM Fell DW Pica SC', serif" => "IM Fell DW Pica SC",
						"'Uncial Antiqua', display" => "Uncial Antiqua",
						"'Rouge Script', handwriting" => "Rouge Script",
						"'Ruluko', sans-serif" => "Ruluko",
						"'Tulpen One', display" => "Tulpen One",
						"'Gurajada', serif" => "Gurajada",
						"'Inika', serif" => "Inika",
						"'Catamaran', sans-serif" => "Catamaran",
						"'Bilbo', handwriting" => "Bilbo",
						"'Artifika', serif" => "Artifika",
						"'Sancreek', display" => "Sancreek",
						"'Iceland', display" => "Iceland",
						"'Cagliostro', sans-serif" => "Cagliostro",
						"'Rubik', sans-serif" => "Rubik",
						"'Delius Unicase', handwriting" => "Delius Unicase",
						"'Averia Serif Libre', display" => "Averia Serif Libre",
						"'Fondamento', handwriting" => "Fondamento",
						"'Habibi', serif" => "Habibi",
						"'Nova Round', display" => "Nova Round",
						"'Sonsie One', display" => "Sonsie One",
						"'Fascinate', display" => "Fascinate",
						"'Sunshiney', handwriting" => "Sunshiney",
						"'Stint Ultra Condensed', display" => "Stint Ultra Condensed",
						"'IM Fell Great Primer', serif" => "IM Fell Great Primer",
						"'Overlock SC', display" => "Overlock SC",
						"'Krona One', sans-serif" => "Krona One",
						"'Miniver', display" => "Miniver",
						"'Redressed', handwriting" => "Redressed",
						"'Text Me One', sans-serif" => "Text Me One",
						"'Sail', display" => "Sail",
						"'Paprika', display" => "Paprika",
						"'Stint Ultra Expanded', display" => "Stint Ultra Expanded",
						"'McLaren', display" => "McLaren",
						"'Aguafina Script', handwriting" => "Aguafina Script",
						"'Milonga', display" => "Milonga",
						"'New Rocker', display" => "New Rocker",
						"'IM Fell Great Primer SC', serif" => "IM Fell Great Primer SC",
						"'Nova Slim', display" => "Nova Slim",
						"'Wallpoet', display" => "Wallpoet",
						"'IM Fell French Canon SC', serif" => "IM Fell French Canon SC",
						"'Buda', display" => "Buda",
						"'Ramabhadra', sans-serif" => "Ramabhadra",
						"'Jacques Francois', serif" => "Jacques Francois",
						"'Wellfleet', display" => "Wellfleet",
						"'Rammetto One', display" => "Rammetto One",
						"'Scheherazade', serif" => "Scheherazade",
						"'Croissant One', display" => "Croissant One",
						"'Dynalight', display" => "Dynalight",
						"'Spirax', display" => "Spirax",
						"'Port Lligat Sans', sans-serif" => "Port Lligat Sans",
						"'Autour One', display" => "Autour One",
						"'Linden Hill', serif" => "Linden Hill",
						"'Averia Libre', display" => "Averia Libre",
						"'Palanquin Dark', sans-serif" => "Palanquin Dark",
						"'Palanquin', sans-serif" => "Palanquin",
						"'Snippet', sans-serif" => "Snippet",
						"'Suwannaphum', display" => "Suwannaphum",
						"'Fira Mono', monospace" => "Fira Mono",
						"'Alike Angular', serif" => "Alike Angular",
						"'Romanesco', handwriting" => "Romanesco",
						"'Galindo', display" => "Galindo",
						"'Prociono', serif" => "Prociono",
						"'Offside', display" => "Offside",
						"'Sarina', display" => "Sarina",
						"'Pirata One', display" => "Pirata One",
						"'MedievalSharp', display" => "MedievalSharp",
						"'Battambang', display" => "Battambang",
						"'Bigshot One', display" => "Bigshot One",
						"'Antic Didone', serif" => "Antic Didone",
						"'Jolly Lodger', display" => "Jolly Lodger",
						"'Germania One', display" => "Germania One",
						"'Snowburst One', display" => "Snowburst One",
						"'League Script', handwriting" => "League Script",
						"'IM Fell Double Pica SC', serif" => "IM Fell Double Pica SC",
						"'Julee', handwriting" => "Julee",
						"'Iceberg', display" => "Iceberg",
						"'Piedra', display" => "Piedra",
						"'Atomic Age', display" => "Atomic Age",
						"'Miltonian Tattoo', display" => "Miltonian Tattoo",
						"'Glass Antiqua', display" => "Glass Antiqua",
						"'UnifrakturCook', display" => "UnifrakturCook",
						"'Trykker', serif" => "Trykker",
						"'Martel Sans', sans-serif" => "Martel Sans",
						"'GFS Neohellenic', sans-serif" => "GFS Neohellenic",
						"'Kurale', serif" => "Kurale",
						"'Spicy Rice', display" => "Spicy Rice",
						"'Bokor', display" => "Bokor",
						"'Della Respira', serif" => "Della Respira",
						"'Mandali', sans-serif" => "Mandali",
						"'Ribeye', display" => "Ribeye",
						"'Kenia', display" => "Kenia",
						"'Jaldi', sans-serif" => "Jaldi",
						"'Nosifer', display" => "Nosifer",
						"'Astloch', display" => "Astloch",
						"'Montserrat Subrayada', sans-serif" => "Montserrat Subrayada",
						"'Itim', handwriting" => "Itim",
						"'Trochut', display" => "Trochut",
						"'Mrs Saint Delafield', handwriting" => "Mrs Saint Delafield",
						"'Ruthie', handwriting" => "Ruthie",
						"'Nova Flat', display" => "Nova Flat",
						"'Ranchers', display" => "Ranchers",
						"'Modern Antiqua', display" => "Modern Antiqua",
						"'Devonshire', handwriting" => "Devonshire",
						"'Lovers Quarrel', handwriting" => "Lovers Quarrel",
						"'Montaga', serif" => "Montaga",
						"'Wendy One', sans-serif" => "Wendy One",
						"'Elsie Swash Caps', display" => "Elsie Swash Caps",
						"'Passero One', display" => "Passero One",
						"'Galdeano', sans-serif" => "Galdeano",
						"'Joti One', display" => "Joti One",
						"'Sarpanch', sans-serif" => "Sarpanch",
						"'Vampiro One', display" => "Vampiro One",
						"'Peralta', display" => "Peralta",
						"'Londrina Outline', display" => "Londrina Outline",
						"'Irish Grover', display" => "Irish Grover",
						"'Elsie', display" => "Elsie",
						"'Gorditas', display" => "Gorditas",
						"'Aubrey', display" => "Aubrey",
						"'Smythe', display" => "Smythe",
						"'Sofadi One', display" => "Sofadi One",
						"'Akronim', display" => "Akronim",
						"'Warnes', display" => "Warnes",
						"'Ribeye Marrow', display" => "Ribeye Marrow",
						"'Erica One', display" => "Erica One",
						"'Chango', display" => "Chango",
						"'Geostar Fill', display" => "Geostar Fill",
						"'Lancelot', display" => "Lancelot",
						"'Emilys Candy', display" => "Emilys Candy",
						"'Petrona', serif" => "Petrona",
						"'Bubbler One', sans-serif" => "Bubbler One",
						"'Nokora', serif" => "Nokora",
						"'Chicle', display" => "Chicle",
						"'Combo', display" => "Combo",
						"'Almendra', serif" => "Almendra",
						"'Molle', handwriting" => "Molle",
						"'Jacques Francois Shadow', display" => "Jacques Francois Shadow",
						"'Faster One', display" => "Faster One",
						"'Original Surfer', display" => "Original Surfer",
						"'Rum Raisin', sans-serif" => "Rum Raisin",
						"'Monsieur La Doulaise', handwriting" => "Monsieur La Doulaise",
						"'Plaster', display" => "Plaster",
						"'Miltonian', display" => "Miltonian",
						"'Asset', display" => "Asset",
						"'Goblin One', display" => "Goblin One",
						"'Eagle Lake', handwriting" => "Eagle Lake",
						"'Margarine', display" => "Margarine",
						"'Smokum', display" => "Smokum",
						"'Nova Script', display" => "Nova Script",
						"'Mrs Sheppards', handwriting" => "Mrs Sheppards",
						"'Nova Cut', display" => "Nova Cut",
						"'Laila', serif" => "Laila",
						"'Eater', display" => "Eater",
						"'Nova Oval', display" => "Nova Oval",
						"'Emblema One', display" => "Emblema One",
						"'Butterfly Kids', handwriting" => "Butterfly Kids",
						"'Freehand', display" => "Freehand",
						"'Diplomata', display" => "Diplomata",
						"'Revalia', display" => "Revalia",
						"'Geostar', display" => "Geostar",
						"'Londrina Shadow', display" => "Londrina Shadow",
						"'Hind Vadodara', sans-serif" => "Hind Vadodara",
						"'Federant', display" => "Federant",
						"'Felipa', handwriting" => "Felipa",
						"'Ewert', display" => "Ewert",
						"'Content', display" => "Content",
						"'Underdog', display" => "Underdog",
						"'Ranga', display" => "Ranga",
						"'Londrina Sketch', display" => "Londrina Sketch",
						"'Purple Purse', display" => "Purple Purse",
						"'Supermercado One', display" => "Supermercado One",
						"'Marko One', serif" => "Marko One",
						"'Sumana', serif" => "Sumana",
						"'Miss Fajardose', handwriting" => "Miss Fajardose",
						"'Moul', display" => "Moul",
						"'Risque', display" => "Risque",
						"'Vesper Libre', serif" => "Vesper Libre",
						"'Sirin Stencil', display" => "Sirin Stencil",
						"'Meie Script', handwriting" => "Meie Script",
						"'Diplomata SC', display" => "Diplomata SC",
						"'Bayon', display" => "Bayon",
						"'Dangrek', display" => "Dangrek",
						"'Princess Sofia', handwriting" => "Princess Sofia",
						"'Bigelow Rules', display" => "Bigelow Rules",
						"'Rozha One', serif" => "Rozha One",
						"'Fascinate Inline', display" => "Fascinate Inline",
						"'Mr Bedfort', handwriting" => "Mr Bedfort",
						"'Seymour One', sans-serif" => "Seymour One",
						"'Siemreap', display" => "Siemreap",
						"'Almendra SC', serif" => "Almendra SC",
						"'Macondo Swash Caps', display" => "Macondo Swash Caps",
						"'Suranna', serif" => "Suranna",
						"'Dr Sugiyama', handwriting" => "Dr Sugiyama",
						"'Metal Mania', display" => "Metal Mania",
						"'Butcherman', display" => "Butcherman",
						"'Odor Mean Chey', display" => "Odor Mean Chey",
						"'Taprom', display" => "Taprom",
						"'Sevillana', display" => "Sevillana",
						"'Ramaraja', serif" => "Ramaraja",
						"'Arbutus', display" => "Arbutus",
						"'Koulen', display" => "Koulen",
						"'Macondo', display" => "Macondo",
						"'Dekko', handwriting" => "Dekko",
						"'Jim Nightshade', handwriting" => "Jim Nightshade",
						"'Arya', sans-serif" => "Arya",
						"'Ruge Boogie', handwriting" => "Ruge Boogie",
						"'NTR', sans-serif" => "NTR",
						"'Chela One', display" => "Chela One",
						"'Metal', display" => "Metal",
						"'Kantumruy', sans-serif" => "Kantumruy",
						"'Stalinist One', display" => "Stalinist One"
					),
					'inherit',
					__('Search for and select fonts','yp')
				)."
				
				
				".yp_get_select_markup(
					'font-weight',
					__('Font Weight','yp')
					,array(
						'300' => __('Light',"yp").' 300',
						'400' => __('normal',"yp").' 400',
						'500' => __('Semi-Bold',"yp").' 500',
						'600' => __('Bold',"yp").' 600',
						'700' => __('Extra-Bold',"yp").' 700'
					),
					'inherit',
					__('Set the font weight','yp')
				)."
	
				".yp_get_color_markup(
					'color',
					__('Color','yp'),
					'Set the text color'
				)."

				".yp_get_select_markup(
					'text-shadow',
					__('Text Shadow','yp')
					,array(
						'none' => 'none',
						'rgba(0, 0, 0, 0.3) 0px 1px 1px' => 'Basic Shadow',
						'rgb(255, 255, 255) 1px 1px 0px, rgb(170, 170, 170) 2px 2px 0px' => 'Shadow Multiple',
						'rgb(255, 0, 0) -1px 0px 0px, rgb(0, 255, 255) 1px 0px 0px' => 'Anaglyph',
						'rgb(255, 255, 255) 0px 1px 1px, rgb(0, 0, 0) 0px -1px 1px' => 'Emboss',
						'rgb(255, 255, 255) 0px 0px 2px, rgb(255, 255, 255) 0px 0px 4px, rgb(255, 255, 255) 0px 0px 6px, rgb(255, 119, 255) 0px 0px 8px, rgb(255, 0, 255) 0px 0px 12px, rgb(255, 0, 255) 0px 0px 16px, rgb(255, 0, 255) 0px 0px 20px, rgb(255, 0, 255) 0px 0px 24px' => 'Neon',
						'rgb(0, 0, 0) 0px 1px 1px, rgb(0, 0, 0) 0px -1px 1px, rgb(0, 0, 0) 1px 0px 1px, rgb(0, 0, 0) -1px 0px 1px' => 'Outline'
					),
					'none'
				)."

				".yp_get_slider_markup(
					'font-size',
					__('Font Size','yp'),
					'inherit',
					1,        // decimals
					'0,72',   // px value
					'0,100',  // percentage value
					'0,8'     // Em value
				)."
				
				".yp_get_slider_markup(
					'line-height',
					__('Line Height','yp'),
					'inherit',
					1,        // decimals
					'0,72',   // px value
					'0,100',  // percentage value
					'0,8',     // Em value,
					__('Set the leading','yp')
				)."
				
				".yp_get_radio_markup(
					'font-style',
					__('Font Style','yp'),
					array(
						'normal' => __('Normal','yp'),
						'italic' => __('Italic','yp')
					),
					'inherit'
				)."

				".yp_get_radio_markup(
					'text-align',
					__('Text Align','yp'),
					array(
						'left' => __('left','yp'),
						'center' => __('center','yp'),
						'right' => __('right','yp'),
						'justify' => __('justify','yp')
					),
					'start'
				)."
				
				".yp_get_radio_markup(
					'text-transform',
					__('Text Transform','yp'),
					array(
						'uppercase' => __('upprcase','yp'),
						'lowercase' => __('lowercase','yp'),
						'capitalize' => __('capitalize','yp')
					),
					'none'						
				)."
			
				
				".yp_get_slider_markup(
					'letter-spacing',
					__('Letter Spacing','yp'),
					'inherit',
					1,        // decimals
					'-5,10',   // px value
					'0,100',  // percentage value
					'-1,3'     // Em value
				)."
				
				".yp_get_slider_markup(
					'word-spacing',
					__('Word Spacing','yp'),
					'inherit',
					1,        // decimals
					'-5,20',   // px value
					'0,100',  // percentage value
					'-1,3'     // Em value,
				)."

				".yp_get_radio_markup(
					'text-decoration',
					__('text Decoration','yp'),
					array(
						'overline' => __('overline','yp'),
						'line-through' => __('through','yp'),
						'underline' => __('underline','yp')
					),
					'none'
				)."
				
			</div>
		</li>
		
		<li class='background-option'>
			<h3>".__('Background','yp')." ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>
			
				<a class='yp-advanced-link yp-top yp-special-css-link yp-just-desktop yp-parallax-link'>".__('Background Parallax','yp')."</a>
				<div class='yp-advanced-option yp-special-css-area yp-just-desktop background-parallax-div'>

					<div class='little-break yp-lite'></div>

					".yp_get_radio_markup( // Special CSS
						'background-parallax',
						__('Effect Status','yp'),
						array(
							'true' => __('Enable','yp'),
							'disable' => __('Disable','yp')
						),
						false						
					)."
					
					".yp_get_slider_markup(
						'background-parallax-speed',
						__('Parallax Speed','yp'),
						'',
						2,        // decimals
						'1,10',   // px value
						'1,10',  // percentage value
						'1,10'     // Em value
					)."
					
					".yp_get_slider_markup(
						'background-parallax-x',
						__('Parallax Position X','yp'),
						'',
						2,        // decimals
						'1,100',   // px value
						'1,100',  // percentage value
						'1,100'     // Em value
					)."
					
				</div>
				
				".yp_get_color_markup(
					'background-color',
					__('Background Color','yp')
				)."
				
				".yp_get_input_markup(
					'background-image',
					__('Background Image','yp'),
					'none'
				)."

				".yp_get_select_markup(
					'background-position',
					__('BG. Position','yp'),
					array(
						'0% 0%' => __('left top','yp'),
						'0% 50%' => __('left center','yp'),
						'0% 100%' => __('left bottom','yp'),
						'100% 0%' => __('right top','yp'),
						'100% 50%' => __('right center','yp'),
						'100% 100%' => __('right bottom','yp'),
						'50% 0%' => __('center top','yp'),
						'50% 50%' => __('center center','yp'),
						'50% 100%' => __('center bottom','yp')
					),
					'0% 0%',
					__('Sets the starting position of a background image','yp')
				)."

				".yp_get_radio_markup(
					'background-size',
					__('Background Size','yp'),
					array(
						'length' => __('length','yp'),
						'cover' => __('cover','yp'),
						'contain' => __('contain','yp')
					),
					'auto auto',
					__('The size of the background image','yp')
				)."				
				
				".yp_get_radio_markup(
					'background-repeat',
					__('Background Repeat','yp'),
					array(
						'repeat-x' => __('repeat-x','yp'),
						'repeat-y' => __('repeat-y','yp'),
						'no-repeat' => __('no-repeat','yp')
					),
					'repeat',
					__('Sets if background image will be repeated','yp')
				)."
				
				".yp_get_radio_markup(
					'background-attachment',
					__('BG. Attachment','yp'),
					array(
						'fixed' => __('fixed','yp'),
						'local' => __('local','yp')
					),
					'scroll',
					__('Sets whether a background image is fixed or scrolls with the rest of the page','yp')
				)."				
				
			</div>
		</li>
		
		<li class='margin-option'>
			<h3>".__('Margin','yp')." ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>

				<div class='lock-btn'></div>
				
				".yp_get_slider_markup(
					'margin-left',
					__('Margin Left','yp'),
					'auto',
					0,        // decimals
					'-50,200',   // px value
					'-100,100',  // percentage value
					'-6,26',     // Em value,
					__('The margin clears an area around an element. The margin does not have a background color, and is completely transparent.','yp')
				)."
				
				".yp_get_slider_markup(
					'margin-right',
					__('Margin Right','yp'),
					'auto',
					0,        // decimals
					'-50,200',   // px value
					'-100,100',  // percentage value
					'-6,26',     // Em value
					__('The margin clears an area around an element. The margin does not have a background color, and is completely transparent.','yp')
				)."
				
				".yp_get_slider_markup(
					'margin-top',
					__('Margin Top','yp'),
					'auto',
					0,        // decimals
					'-50,200',   // px value
					'-100,100',  // percentage value
					'-6,26',     // Em value
					__('The margin clears an area around an element. The margin does not have a background color, and is completely transparent.','yp')
				)."
				
				".yp_get_slider_markup(
					'margin-bottom',
					__('Margin Bottom','yp'),
					'auto',
					0,        // decimals
					'-50,200',   // px value
					'-100,100',  // percentage value
					'-6,26',     // Em value
					__('The margin clears an area around an element. The margin does not have a background color, and is completely transparent.','yp')
				)."
				
				
			</div>
		</li>
		
		<li class='padding-option'>
			<h3>".__('Padding','yp')." ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>
				
				<div class='lock-btn'></div>

				".yp_get_slider_markup(
					'padding-left',
					__('Padding Left','yp'),
					'',
					0,        // decimals
					'0,200',   // px value
					'0,100',  // percentage value
					'0,26',     // Em value
					__('The padding clears an area around the content of an element. The padding is affected by the background color of the element.','yp')
				)."
				
				".yp_get_slider_markup(
					'padding-right',
					__('Padding Right','yp'),
					'',
					0,        // decimals
					'0,200',   // px value
					'0,100',  // percentage value
					'0,26',     // Em value
					__('The padding clears an area around the content of an element. The padding is affected by the background color of the element.','yp')
				)."
				
				".yp_get_slider_markup(
					'padding-top',
					__('Padding Top','yp'),
					'',
					0,        // decimals
					'0,200',   // px value
					'0,100',  // percentage value
					'0,26',     // Em value
					__('The padding clears an area around the content of an element. The padding is affected by the background color of the element.','yp')
				)."
				
				".yp_get_slider_markup(
					'padding-bottom',
					__('Padding Bottom','yp'),
					'',
					0,        // decimals
					'0,200',   // px value
					'0,100',  // percentage value
					'0,26',     // Em value
					__('The padding clears an area around the content of an element. The padding is affected by the background color of the element.','yp')
				)."
				
			
			</div>
		</li>

		
		<li class='border-option'>
			<h3>".__('Border','yp')." ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>
				
				
				".yp_get_radio_markup(
					'border-style',
					__('Border Style','yp'),
					array(
						'solid' => __('solid','yp'),
						'dotted' => __('dotted','yp'),
						'dashed' => __('dashed','yp'),
						'hidden' => __('hidden','yp')
					),
					'none',
					__('Sets the style of an elements four borders. This property can have from one to four values.','yp')
				)."
				
				
				".yp_get_slider_markup(
					'border-width',
					__('Border Width','yp'),
					'',
					0,        // decimals
					'0,20',   // px value
					'0,100',  // percentage value
					'0,3',     // Em value
					__('Sets the width of an elements four borders. This property can have from one to four values.','yp')
				)."
				
				".yp_get_color_markup(
					'border-color',
					__('Border Color','yp'),
					__('Sets the color of an elements four borders.','yp')
				)."
				
				
				<a class='yp-advanced-link yp-special-css-link yp-border-special'>".__('Border Top','yp')."</a>
				<div class='yp-advanced-option yp-special-css-area yp-border-special-content'>
				".yp_get_radio_markup(
					'border-top-style',
					__('Style','yp'),
					array(
						'solid' => __('solid','yp'),
						'dotted' => __('dotted','yp'),
						'dashed' => __('dashed','yp'),
						'hidden' => __('hidden','yp')
					),
					'none',
					__('Sets the style of an elements top border.','yp')
				)."
				
				".yp_get_slider_markup(
					'border-top-width',
					__('Width','yp'),
					'',
					0,        // decimals
					'0,20',   // px value
					'0,100',  // percentage value
					'0,3',     // Em value
					__('Sets the width of an elements top border.','yp')
				)."
				
				".yp_get_color_markup(
					'border-top-color',
					__('Color','yp'),
					__('Sets the color of an elements top border.','yp')
				)."
				</div>
				
				<a class='yp-advanced-link yp-special-css-link yp-border-special'>".__('Border Right','yp')."</a>
				<div class='yp-advanced-option yp-special-css-area yp-border-special-content'>
				".yp_get_radio_markup(
					'border-right-style',
					__('Style','yp'),
					array(
						'solid' => __('solid','yp'),
						'dotted' => __('dotted','yp'),
						'dashed' => __('dashed','yp'),
						'hidden' => __('hidden','yp')
					),
					'none',
					__('Sets the style of an elements right border.','yp')
				)."
				
				".yp_get_slider_markup(
					'border-right-width',
					__('Width','yp'),
					'',
					0,        // decimals
					'0,20',   // px value
					'0,100',  // percentage value
					'0,3',     // Em value
					__('Sets the width of an elements right border.','yp')
				)."
				
				".yp_get_color_markup(
					'border-right-color',
					__('Color','yp'),
					__('Sets the color of an elements right border.','yp')
				)."
				</div>
				
				
				<a class='yp-advanced-link yp-special-css-link yp-border-special'>".__('Border Bottom','yp')."</a>
				<div class='yp-advanced-option yp-special-css-area yp-border-special-content'>
				".yp_get_radio_markup(
					'border-bottom-style',
					__('Style','yp'),
					array(
						'solid' => __('solid','yp'),
						'dotted' => __('dotted','yp'),
						'dashed' => __('dashed','yp'),
						'hidden' => __('hidden','yp')
					),
					'none',
					__('Sets the style of an elements bottom border.','yp')
				)."
				
				".yp_get_slider_markup(
					'border-bottom-width',
					__('Width','yp'),
					'',
					0,        // decimals
					'0,20',   // px value
					'0,100',  // percentage value
					'0,3',     // Em value
					__('Sets the width of an elements bottom border.','yp')
				)."
				
				".yp_get_color_markup(
					'border-bottom-color',
					__('Color','yp'),
					__('Sets the color of an elements bottom border.','yp')
				)."
				</div>
				
				
				<a class='yp-advanced-link yp-special-css-link yp-border-special yp-border-special-last'>".__('Border Left','yp')."</a>
				<div class='yp-advanced-option yp-special-css-area yp-border-special-content'>
				".yp_get_radio_markup(
					'border-left-style',
					__('Style','yp'),
					array(
						'solid' => __('solid','yp'),
						'dotted' => __('dotted','yp'),
						'dashed' => __('dashed','yp'),
						'hidden' => __('hidden','yp')
					),
					'none',
					__('Sets the style of an elements left border.','yp')
				)."
				
				".yp_get_slider_markup(
					'border-left-width',
					__('Width','yp'),
					'',
					0,        // decimals
					'0,20',   // px value
					'0,100',  // percentage value
					'0,3',     // Em value
					__('Sets the width of an elements left border.','yp')
				)."
				
				".yp_get_color_markup(
					'border-left-color',
					__('Color','yp'),
					__('Sets the color of an elements left border.','yp')
				)."
				</div>
				
			</div>
		</li>
		
		<li class='border-radius-option'>
			<h3>".__('Border Radius','yp')." ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>
				
				<div class='lock-btn'></div>
				".yp_get_slider_markup(
					'border-top-left-radius',
					__('Top Left Radius','yp'),
					'',
					0,        // decimals
					'0,50',   // px value
					'0,50',  // percentage value
					'0,6',     // Em value
					__('Defines the shape of the border of the top-left corner','yp')
				)."
				
				".yp_get_slider_markup(
					'border-top-right-radius',
					__('Top Right Radius','yp'),
					'',
					0,        // decimals
					'0,50',   // px value
					'0,50',  // percentage value
					'0,6',     // Em value
					__('Defines the shape of the border of the top-right corner','yp')
				)."
				
				".yp_get_slider_markup(
					'border-bottom-left-radius',
					__('Bottom Left Radius','yp'),
					'',
					0,        // decimals
					'0,50',   // px value
					'0,50',  // percentage value
					'0,6',     // Em value
					__('Defines the shape of the border of the bottom-left corner','yp')
				)."
				
				".yp_get_slider_markup(
					'border-bottom-right-radius',
					__('Bottom Right Radius','yp'),
					'',
					0,        // decimals
					'0,50',   // px value
					'0,50',  // percentage value
					'0,6',     // Em value
					__('Defines the shape of the border of the bottom-right corner','yp')
				)."
				
				
			</div>
		</li>
		
		<li class='position-option'>
			<h3>".__('Position','yp')." ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>

				<p class='yp-alert-warning yp-top-alert'>".__('Click and hold the mouse button down over selected element and drag.','yp')."</p>
			
				".yp_get_slider_markup(
					'z-index',
					__('Z Index','yp'),
					'auto',
					0,        // decimals
					'-10,1000',   // px value
					'-10,1000',  // percentage value
					'-10,1000',     // Em value
					__('Specifies the stack order of an element. Z index only works on positioned elements (position:absolute, position:relative, or position:fixed).','yp')
				)."	
				
				".yp_get_radio_markup(
					'position',
					__('Position','yp'),
					array(
						'static' => 'static',
						'relative' => 'relative',
						'absolute' => 'absolute',
						'fixed' => 'fixed'
					),
					'',
					__('Specifies the type of positioning method used for an element','yp')
					
				)."
				
				".yp_get_slider_markup(
					'top',
					__('Top','yp'),
					'auto',
					0,        // decimals
					'-50,200',   // px value
					'0,100',  // percentage value
					'-6,26',     // Em value
					__('For absolutely: positioned elements, the top property sets the top edge of an element to a unit above/below the top edge of its containing element.<br><br>For relatively: positioned elements, the top property sets the top edge of an element to a unit above/below its normal position.','yp')
				)."

				".yp_get_slider_markup(
					'left',
					__('Left','yp'),
					'auto',
					0,        // decimals
					'-50,200',   // px value
					'0,100',  // percentage value
					'-6,26',     // Em value
					__('For absolutely: positioned elements, the left property sets the left edge of an element to a unit to the left/right of the left edge of its containing element.<br><br>For relatively: positioned elements, the left property sets the left edge of an element to a unit to the left/right to its normal position.','yp')
				)."

				".yp_get_slider_markup(
					'bottom',
					__('Bottom','yp'),
					'auto',
					0,        // decimals
					'-50,200',   // px value
					'0,100',  // percentage value
					'-6,26',     // Em value
					__('For absolutely: positioned elements, the bottom property sets the bottom edge of an element to a unit above/below the bottom edge of its containing element.<br><br>For relatively: positioned elements, the bottom property sets the bottom edge of an element to a unit above/below its normal position.','yp')
				)."
				
				".yp_get_slider_markup(
					'right',
					__('Right','yp'),
					'auto',
					0,        // decimals
					'-50,200',   // px value
					'0,100',  // percentage value
					'-6,26',     // Em value
					__('For absolutely: positioned elements, the right property sets the right edge of an element to a unit to the left/right of the right edge of its containing element.<br><br>For relatively: positioned elements, the right property sets the right edge of an element to a unit to the left/right to its normal position.','yp')
				)."
				
			</div>
		</li>
		
		<li class='size-option'>
			<h3>".__('Size','yp')." <span class='yp-badge yp-lite'>Pro</span> ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>

				<p class='yp-alert-warning yp-top-alert'>".__('Click and hold the mouse button down over blue border\'s of selected element and resize.','yp')."</p>
				
				".yp_get_slider_markup(
					'width',
					__('Width','yp'),
					'auto',
					0,        // decimals
					'0,500',   // px value
					'0,100',  // percentage value
					'0,52',     // Em value
					__('Sets the width of an element','yp')
				)."
				
				".yp_get_slider_markup(
					'height',
					__('Height','yp'),
					'auto',
					0,        // decimals
					'0,500',   // px value
					'0,100',  // percentage value
					'0,52',     // Em value
					__('sets the height of an element','yp')
				)."

				".yp_get_radio_markup(
					'box-sizing',
					__('Box Sizing','yp'),
					array(
						'border-box' => __('border-box','yp'),
						'content-box' => __('content-box','yp')
					),
					'content-box',
					__('is used to tell the browser what the sizing properties (width and height) should include. Should they include the border-box? Or just the content-box (which is the default value of the width and height properties)?','yp')
				)."
				
				".yp_get_slider_markup(
					'min-width',
					__('Min Width','yp'),
					'initial',
					0,        // decimals
					'0,500',   // px value
					'0,100',  // percentage value
					'0,52',     // Em value
					__('is used to set the minimum width of an element','yp')
				)."
				
				".yp_get_slider_markup(
					'max-width',
					__('Max Width','yp'),
					'auto',
					0,        // decimals
					'0,500',   // px value
					'0,100',  // percentage value
					'0,52',     // Em value
					__('is used to set the maximum width of an element','yp')
				)."
				
				".yp_get_slider_markup(
					'min-height',
					__('Min Height','yp'),
					'initial',
					0,        // decimals
					'0,500',   // px value
					'0,100',  // percentage value
					'0,52',    // Em value
					__('is used to set the minimum height of an element','yp')
				)."
				
				".yp_get_slider_markup(
					'max-height',
					__('Max Height','yp'),
					'auto',
					0,        // decimals
					'0,500',   // px value
					'0,100',  // percentage value
					'0,52',     // Em value
					__('is used to set the maximum height of an element','yp')
				)."
				
				
			</div>
		</li>

		<li class='animation-option'>
			<h3>".__('Animation','yp')." <span class='yp-badge yp-lite'>Pro</span> <span class='yp-badge yp-anim-recording'>".__('Recording','yp')."</span> ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>
				
				<p class='yp-alert-warning yp-top-alert yp-lite'>Animation ".__('property not available for lite version.','yp')." <a target='_blank' href='http://waspthemes.com/yellow-pencil/buy'>".__('Upgrade','yp')."?</a></p>
				
				<div class='animation-links-control yp-just-desktop'>

				<a class='yp-advanced-link yp-special-css-link yp-just-desktop yp-add-animation-link'>".__('Create New Animation','yp')."</a>

				<a class='yp-advanced-link yp-special-css-link yp-just-desktop yp-animation-player'>".__('Play','yp')."</a>

				<a class='yp-advanced-link yp-special-css-link yp-just-desktop yp-animation-creator-start'>".__('Create','yp')."</a>

				<div class='yp-clearfix'></div>

				</div>

			";

				// Default animations
				$animations = array(
					'none' => 'none',
					'bounce' => 'bounce',
					'spin' => 'spin',
					'flash' => 'flash',
					'swing' => 'swing',
					'pulse' => 'pulse',
					'rubberBand' => 'rubberBand',
					'shake' => 'shake',
					'tada' => 'tada',
					'wobble' => 'wobble',
					'jello' => 'jello',
					'bounceIn' => 'bounceIn',
						
					'spaceInUp' => 'spaceInUp',
					'spaceInRight' => 'spaceInRight',
					'spaceInDown' => 'spaceInDown',
					'spaceInLeft' => 'spaceInLeft',
					'push' => 'push',
					'pop' => 'pop',
					'bob' => 'bob',
					'wobble-horizontal' => 'wobble-horizontal',
											
					'bounceInDown' => 'bounceInDown',
					'bounceInLeft' => 'bounceInLeft',
					'bounceInRight' => 'bounceInRight',
					'bounceInUp' => 'bounceInUp',
					'fadeIn' => 'fadeIn',
					'fadeInDown' => 'fadeInDown',
					'fadeInDownBig' => 'fadeInDownBig',
					'fadeInLeft' => 'fadeInLeft',
					'fadeInLeftBig' => 'fadeInLeftBig',
					'fadeInRight' => 'fadeInRight',
					'fadeInRightBig' => 'fadeInRightBig',
					'fadeInUp' => 'fadeInUp',
					'fadeInUpBig' => 'fadeInUpBig',
					'flipInX' => 'flipInX',
					'flipInY' => 'flipInY',
					'lightSpeedIn' => 'lightSpeedIn',
					'rotateIn' => 'rotateIn',
					'rotateInDownLeft' => 'rotateInDownLeft',
					'rotateInDownRight' => 'rotateInDownRight',
					'rotateInUpLeft' => 'rotateInUpLeft',
					'rotateInUpRight' => 'rotateInUpRight',
					'rollIn' => 'rollIn',
					'zoomIn' => 'zoomIn',
					'zoomInDown' => 'zoomInDown',
					'zoomInLeft' => 'zoomInLeft',
					'zoomInRight' => 'zoomInRight',
					'zoomInUp' => 'zoomInUp',
					'slideInDown' => 'slideInDown',
					'slideInLeft' => 'slideInLeft',
					'slideInRight' => 'slideInRight',
					'slideInUp' => 'slideInUp'
				);

				// Add dynamic animations.
				$all_options =  wp_load_alloptions();
				foreach($all_options as $name => $value){
					if(stristr($name, 'yp_anim')){
						$name = str_replace("yp_anim_", "", $name);
						$animations[$name] = ucwords(strtolower($name));
					}
				}
				
				echo " ".yp_get_select_markup(
					'animation-name',
					__('Animation','yp'),
					$animations,
					'none'
				)."
				
				".yp_get_select_markup(
					'animation-play',
					__('Animation Play','yp'),
					array(
						'yp_onscreen' => __('onScreen','yp'),
						'yp_hover' => __('Hover','yp'),
						'yp_click' => __('Click','yp'),
						'yp_focus' => __('Focus','yp')
					),
					'yp_onscreen',
					__('OnScreen: Playing animation when element visible on screen.<br><br>Hover: Playing animation when mouse on element.<br><br>Click: Playing animation when element clicked.<br><br>Focus: Playing element when click on an text field.','yp')
				)."
				
				".yp_get_select_markup(
					'animation-iteration-count',
					__('animation Iteration','yp'),
					array(
						'1' => '1',
						'2' => '2',
						'infinite' => __('infinite','yp')
					),
					'1'
				)."
				
				".yp_get_input_markup(
						'set-animation-name',
						__('Set Animation Name','yp'),
						'none'
					)."

				".yp_get_slider_markup(
					'animation-duration',
					__('Animation Duration','yp'),
					'0',
					2,        // decimals
					'1,10',   // px value
					'1,10',  // percentage value
					'1,10'     // Em/ms value
				)."

				".yp_get_slider_markup(
					'animation-delay',
					__('Animation Delay','yp'),
					'0',
					2,        // decimals
					'0,10',   // px value
					'0,10',  // percentage value
					'0,10'     // Em/ms value
				)."
				
			</div>
		</li>
		
		<li class='filters-option'>
			<h3>".__('Filters','yp')." <span class='yp-badge yp-lite'>Pro</span>  ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>

				<p class='yp-alert-warning yp-top-alert yp-lite'>Filter ".__('property not available for lite version.','yp')." <a target='_blank' href='http://waspthemes.com/yellow-pencil/buy'>".__('Upgrade','yp')."?</a></p>

				".yp_get_slider_markup(
					'blur-filter',
					__('Blur','yp'),
					'0',
					2,        // decimals
					'0,10',   // px value
					'0,10',  // percentage value
					'0,10'     // Em value
				)."
				
				".yp_get_slider_markup(
					'brightness-filter',
					__('Brightness','yp'),
					'0',
					2,        // decimals
					'0,10',   // px value
					'0,10',  // percentage value
					'0,10'     // Em value
				)."
				
				".yp_get_slider_markup(
					'grayscale-filter',
					__('Grayscale','yp'),
					'0',
					2,        // decimals
					'0,1',   // px value
					'0,1',  // percentage value
					'0,1'     // Em value
				)."
				
				".yp_get_slider_markup(
					'contrast-filter',
					__('Contrast','yp'),
					'0',
					2,        // decimals
					'0,10',   // px value
					'0,10',  // percentage value
					'0,10'     // Em value
				)."
				
				".yp_get_slider_markup(
					'hue-rotate-filter',
					__('Hue Rotate','yp'),
					'0',
					2,        // decimals
					'0,360',   // px value
					'0,360',  // percentage value
					'0,360'     // Em value
				)."
				
				".yp_get_slider_markup(
					'saturate-filter',
					__('Saturate','yp'),
					'0',
					2,        // decimals
					'0,10',   // px value
					'0,10',  // percentage value
					'0,10'     // Em value
				)."
				
				".yp_get_slider_markup(
					'sepia-filter',
					__('Sepia','yp'),
					'0',
					2,        // decimals
					'0,1',   // px value
					'0,1',  // percentage value
					'0,1'     // Em value
				)."
			</div>
		</li>
		
		<li class='box-shadow-option'>
			<h3>".__('Box Shadow','yp')." ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>

				<p class='yp-alert-warning yp-top-alert yp-has-box-shadow'>".__('Set transparent color for hide box shadow property.','yp')."</p>

				".yp_get_color_markup(
					'box-shadow-color',
					__('Color','yp')
				)."
				
				".yp_get_slider_markup(
					'box-shadow-blur-radius',
					__('Blur Radius','yp'),
					'0',
					0,        	// decimals
					'0,50',   // px value
					'0,50',  // percentage value
					'0,50'     // Em value
				)."
				
				".yp_get_slider_markup(
					'box-shadow-spread',
					__('Spread','yp'),
					'0',
					0,        	// decimals
					'-50,100',   // px value
					'-50,100',  // percentage value
					'-50,100'     // Em value
				)."

				".yp_get_radio_markup(
					'box-shadow-inset',
					__('Inset','yp'),
					array(
						'no' => __('no','yp'),
						'inset' => __('inset','yp')
					),
					false
				)."		

				".yp_get_slider_markup(
					'box-shadow-horizontal',
					__('Horizontal Length','yp'),
					'0',
					0,        // decimals
					'-50,50',   // px value
					'-50,50',  // percentage value
					'-50,50'     // Em value
				)."
				
				".yp_get_slider_markup(
					'box-shadow-vertical',
					__('Vertical Length','yp'),
					'0',
					0,        	// decimals
					'-50,50',   // px value
					'-50,50',  // percentage value
					'-50,50'     // Em value
				)."

			</div>
		</li>
		
		<li class='extra-option'>
			<h3>".__('Extra','yp')." ".yp_arrow_icon()."</h3>
			<div class='yp-this-content'>

				<a class='yp-advanced-link yp-top yp-special-css-link yp-transform-link'>".__('Transform','yp')."</a>
				<div class='yp-advanced-option yp-special-css-area yp-transform-area'>
				".yp_get_slider_markup(
					'scale-transform',
					__('Scale','yp'),
					'0',
					2,        // decimals
					'0,5',   // px value
					'0,5',  // percentage value
					'0,5'     // Em value
				)."
				
				".yp_get_slider_markup(
					'rotate-transform',
					__('Rotate','yp'),
					'0',
					0,        // decimals
					'0,360',   // px value
					'0,360',  // percentage value
					'0,360'     // Em value
				)."
				
				".yp_get_slider_markup(
					'translate-x-transform',
					__('Translate X','yp'),
					'0',
					0,        // decimals
					'-50,50',   // px value
					'-50,50',  // percentage value
					'-50,50'     // Em value
				)."
				
				".yp_get_slider_markup(
					'translate-y-transform',
					__('Translate Y','yp'),
					'0',
					0,        // decimals
					'-50,50',   // px value
					'-50,50',  // percentage value
					'-50,50'     // Em value
				)."
				
				".yp_get_slider_markup(
					'skew-x-transform',
					__('Skew X','yp'),
					'0',
					0,        // decimals
					'0,360',   // px value
					'0,360',  // percentage value
					'0,360'     // Em value
				)."
				
				".yp_get_slider_markup(
					'skew-y-transform',
					__('skew Y','yp'),
					'0',
					0,        // decimals
					'0,360',   // px value
					'0,360',  // percentage value
					'0,360'     // Em value
				)."
				</div>
				
				
				".yp_get_slider_markup(
					'opacity',
					__('Opacity','yp'),
					'auto',
					2,        // decimals
					'0,1',   // px value
					'0,1',  // percentage value
					'0,1',     // Em value
					__('The opacity property can take a value from 0.0 - 1.0. The lower value, the more transparent.','yp')
				)."
				
				".yp_get_radio_markup(
					'float',
					__('Float','yp'),
					array(
						'left' => __('left','yp'),
						'right' => __('right','yp')
					),
					'none',
					__('Specifies whether or not a box (an element) should float.','yp')
				)."

				".yp_get_radio_markup(
					'clear',
					__('Clear','yp'),
					array(
						'left' => __('left','yp'),
						'right' => __('right','yp'),
						'both' => __('both','yp')
					),
					'none',
					__('Specifies on which sides of an element where floating elements are not allowed to float.','yp')
				)."
			
				
				".yp_get_radio_markup(
					'display',
					__('Display','yp'),
					array(
						'none' => __('none','yp'),
						'inline' => __('inline','yp'),
						'block' => __('block','yp'),
						'inline-block' => __('inl-blck','yp')
					),
					'inline',
					__('Specifies the type of box used for an element.','yp')
				)."

				".yp_get_radio_markup(
					'visibility',
					__('Visibility','yp'),
					array(
						'visible' => __('visible','yp'),
						'hidden' => __('hidden','yp')
					),
					'inherit',
					__('specifies whether or not an element is visible.','yp')
				)."
				
				".yp_get_radio_markup(
					'overflow-x',
					__('Overflow X','yp'),
					array(
						'hidden' => __('hidden','yp'),
						'scroll' => __('scroll','yp'),
						'auto' => __('auto','yp')
					),
					'visible',
					__('specifies what to do with the left/right edges of the content - if it overflows the elements content area.','yp')
				)."
				
				".yp_get_radio_markup(
					'overflow-y',
					__('Overflow Y','yp'),
					array(
						'hidden' => __('hidden','yp'),
						'scroll' => __('scroll','yp'),
						'auto' => __('auto','yp')
					),
					'visible',
					__('specifies what to do with the left/right edges of the content - if it overflows the elements content area.','yp')
				)."
				
				
			</div>
		</li>
		
		<li class='yp-li-footer'>
			<h3><a target='_blank' href='http://waspthemes.com/yellow-pencil/inc/Documentation/'>".__('Documentation','yp')."</a> / V ".YP_VERSION."</h3>
		</li>
			
	</ul>";