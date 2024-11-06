// Selecciona las secciones y los elementos de la barra lateral
const sections = document.querySelectorAll('.datos-personales, .noticias-perfil');
const asideLinks = {
    'datos-personales': document.getElementById('datos-perfil-link'),
    'noticias-perfil': document.getElementById('noticias-perfil-link')
};

// Configura Intersection Observer
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Activa el enlace correspondiente
            Object.values(asideLinks).forEach(link => link.classList.remove('active'));
            asideLinks[entry.target.className].classList.add('active');
        }
    });
}, { threshold: 0.5 }); // El 50% de la sección debe estar visible para activarse

// Observa cada sección
sections.forEach(section => observer.observe(section));

//////////////////////////////////////////////////////////////////////////////////////////////////

function confirmarEliminacion(event) {
    event.preventDefault();

    const link = event.target.closest('a');

    Swal.fire({
        title: "¿Quieres eliminar esta noticia?",
        showConfirmButton: true,
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: `No`,
        confirmButtonColor: "rgb(82, 153, 153)",
        denyButtonColor: "#dc3741",
        icon: "question",
      }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "La noticia ha sido eliminada",
                icon: "success",
                iconColor: "darkslategray",
                showConfirmButton: true,  // Hacer visible el botón para que el usuario lo cierre
                confirmButtonColor: "darkslategray",
                timer: 2000  // Tiempo en milisegundos (2 segundos)
            }).then(() => {
                // Redirigir después de 2 segundos
                window.location.href = link.href;
            });
        } else if (result.isDenied) {
          Swal.fire("La noticia no ha sido eliminada", "", "error");
        }
      });
}

function confirmarEliminacionUsuario(event) {
    console.log("confirmarEliminacionUsuario ejecutado");

    event.preventDefault();
    
    const link = event.target.closest('a');

    Swal.fire({
        title: "¿Quieres eliminar este usuario?",
        showConfirmButton: true,
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: `No`,
        confirmButtonColor: "rgb(82, 153, 153)",
        denyButtonColor: "#dc3741",
        icon: "question",
      }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "El usuario ha sido eliminado",
                icon: "success",
                iconColor: "darkslategray",
                showConfirmButton: true,
                confirmButtonColor: "darkslategray",
                timer: 2000
            }).then(() => {
                window.location.href = link.href;
            });
        } else if (result.isDenied) {
          Swal.fire("El usuario no ha sido eliminado", "", "error");
        }
      });
}