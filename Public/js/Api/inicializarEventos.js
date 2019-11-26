function initEventos(enventos){
    if (enventos !== null && typeof enventos === "object"){
        var indices = enventos.length - 1;
        for (var i = indices; i > -1 ; i--){
            var obj = enventos[i];
            if (obj !== null && typeof obj === "object"){
                $(document).on(obj.evento, obj.elemento, obj.funcao);
            };
        }; 
    };
};