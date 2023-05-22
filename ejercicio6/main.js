let myFormulario = document.querySelector("#myFormulario");
let myHeaders = new Headers({"Content-Type": "application/json"});
let config = {
    headers: myHeaders,
}
let registros = []; // Array para almacenar los registros

myFormulario.addEventListener("submit", async(e)=>{
    e.preventDefault();
    config.method = "POST";
    let data = Object.fromEntries(new FormData(e.target));
    registros.push(data); // Agregar el registro al array de registros
    config.body = JSON.stringify(registros); // Enviar todos los registros al servidor
    let res = await (await fetch("api.php", config)).text();
    document.querySelector("pre").innerHTML = res;
    console.log(registros); // Imprimir todos los registros en la consola
});