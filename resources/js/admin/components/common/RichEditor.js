import React from 'react'
import { CKEditor } from '@ckeditor/ckeditor5-react';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import UploadAdapter from '../common/UploadAdapter';

//to be finished 上传图片
export default (props)=>{

    const [data, setData] = React.useState('')
    const content = props.content

    const handleBlur = props.handleBlur

    return (
        <CKEditor
            editor={ ClassicEditor }
            data={props.content}
            onInit = {(editor)=>
                {
                    editor.plugins.get("FileRepository").createUploadAdapter = function(loader) {
                        return new UploadAdapter(loader);
                     };

                }
                
                
            }
            onReady={(editor)=>
                {
                    // requestData();
                }
            }
            onChange = {(event,editor)=>{
                // const content = editor.getData();
                // setArticle({...article,content})//bug?:此处一旦setArticle，便只有article.content

            }}

            onBlur = {
                (event,editor)=>{
                    let data = editor.getData();
                    // handleBlur({...article,content:data})
                }
            }

        />
    )
}