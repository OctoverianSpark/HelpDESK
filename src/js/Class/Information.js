export class Information{



    static async formGET(form){

        
        const formData = new FormData(form)

        const params = new URLSearchParams(window.location.search)

        for(const [key,value] of formData.entries()){

                if(value){
                    
                    params.set(key,value)
                }

        }

        window.location.href = window.location.pathname + "?" +  params.toString()










    }

    static fetcherOrganize(column){
        
        const params = new URLSearchParams(window.location.search);

        params.set("orderBy",column);

        window.location.href = window.location.pathname + "?" +  params.toString()




    }


    

    static async getJSON(url){

        const query = await fetch(url)
        .then(response=>response.json())
        
        return query;


    }   

    /**
     * Envia una solicitud POST y convierte la data
     *
     * @param {string} url - La URL de solicitud POST.
     * @param {Object} body - El Cuerpo de la solicitud POST.
     * @returns {Promise<Object>} La repsuesta en formato JSON.
     * @throws {Error} Si falla la solicitud.
     */
    
    static async postJSON(url= "",body = {}){



        const query = await fetch(url, {
            method: "POST",
            headers: {
            "Content-Type": "application/json"
            },
            body: JSON.stringify(body)
        })
        .then(response => response.json())
        .catch(err => console.error(err))
        
        return query;
    }





}