<?php

// Comprova si $aguja està al final de $pajar
function endsWith($pajar, $aguja) {
	if (is_array($aguja) == false) {
		$res = strrpos($pajar, $aguja);
		if ($res == strlen($pajar)-1) {
			return true;	
		} else {
			return false;	
		}
	} else {
		foreach ($aguja as $a) {
			$res = strrpos($pajar, $a) . "<br>";
			if ($res == strlen($pajar)-1) {
				return true;	
			}
		}
		return false;	
	}
}

// Carrega Bootstrap
function loadBootstrap() {
        $data['css_files'] = array(
            'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        );
        $data['js_files'] = array(
                'https://code.jquery.com/jquery-3.2.1.slim.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',
                'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
        );
        return $data;
}


// Crea i renderitza un objecte CRUD
function createGroceryCRUD($table, $subject, $relations = NULL) {
    $crud = new Grocery_CRUD();
    $crud->set_theme('bootstrap-v4');
    $crud->set_language('spanish');

    $crud->set_table($table);

    // Comprova si $subject acaba en vocal per afegir "s" o si acaba en consonant per afegir "es" 
    if (endsWith($subject, array("a", "e", "i", "o", "u"))) {
            $crud->set_subject($subject, $subject . "s");
    } else {
            $crud->set_subject($subject, $subject . "es");
    }

    if ($relations != NULL) {
            foreach ($relations as $relation) {
                    // Comprova si és un array d'arrays
                    if (is_array($relation)) {
                            $crud->set_relation($relation[0], $relation[1], $relation[2]);
                    } else {
                            $crud->set_relation($relations[0], $relations[1], $relations[2]);
                    }
            }
    }
    // Torna l'objecte Grocery_CRUD renderitzat:
    $output = $crud->render();
    
    return $output;
}