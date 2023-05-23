let myFormulario = document.querySelector("#myFormulario");
let myHeaders = new Headers({"Content-Type": "application/json"});
let config = {
    headers: myHeaders,
}
let registros = []; // Array para almacenar los registros

myFormulario.addEventListener("submit", async(e) => {
    e.preventDefault();
    let formData = new FormData(e.target);
    let data = Object.fromEntries(formData);
    registros.push(data); // Agregar el registro al array de registros
    let res = await (await fetch("api.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(registros) // Enviar todos los registros al servidor
    })).json();
    document.querySelector("#resultado").textContent = JSON.stringify(res, null, 2);
});