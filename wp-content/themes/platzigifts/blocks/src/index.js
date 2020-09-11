import {registerBlockType } from '@wordpress/blocks'

registerBlockType(
    'pg/basic',//nombre del bloque
    {
        title:"Basic Block",
        description: " Este es nuestro primer bloque",
        icon:"smiley",
        category: "layout",
        //Vamos a unicializarlo
        attributes:{
            content:{
                type:"string",
                default: "Hello World",
            }
        },
        edit: (props) =>{
            const { attributes: {content}, setAtributes, className, isSelected} = props;// estas funciones provienen de props
            const handlerOnchangeInput = (event) =>{
                setAtributes({content:event.target.value})
            }
            return <input value={content}
            onChange={handlerOnChangeInput}/>
        },//editor
        save: (props) =><h2>{props.attributes.content}</h2>// gestión de la interfaz
    }
)