import {registerBlockType } from '@wordpress/blocks'

registerBlockType(
    'pg/basic',//nombre del bloque
    {
        title:"Basic Block",
        description: " Este es nuestro primer bloque",
        icon:"smiley",
        category: "layout",
        edit: () =><h2>Hello World</h2>,//editor
        save: () =><h2>Hello World</h2>// gestión de la interfaz
    }
)