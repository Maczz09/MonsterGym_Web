const CalculateIMC = (evt) => {
  evt.preventDefault();
  const peso = document.getElementById("peso").value;
  const altura = document.getElementById("altura").value;
  const result = document.getElementById("result");
  const recomendacionIMC = document.getElementById("recomendacionimc");
  const consejoNutricional = document.getElementById("consejo_nutricional");
  const consejoEjercicio = document.getElementById("consejo_ejercicio");

  if (peso !== "" && altura !== "") {
    const bmi = peso / ((altura / 100) ** 2);
    console.log("IMC ES: " + bmi.toFixed(2));
    result.innerHTML = `<p>Tu IMC es: ${bmi.toFixed(2)}</p>`;

    const categoriasIMC = [
      {
        limite: 18.5,
        resultado: "Peso bajo",
        consejo:
          "Consume una dieta rica en calorías y proteínas para aumentar de peso. Se recomienda siempre consultar a su nutricionista.",
        ejercicio:
          "Combina el entrenamiento de fuerza con ejercicios cardiovasculares para aumentar tu masa muscular y mejorar tu salud general.",
        imagen: "../resultadosimgs/bajopeso/underpeso.png",
      },
      {
        limite: 24,
        resultado: "Peso normal",
        consejo:
          "Mantén una dieta equilibrada y variada para mantener tu peso. Se recomienda siempre consultar a su nutricionista.",
        ejercicio:
          "Realiza ejercicio regularmente para mantener tu peso y mejorar tu salud cardiovascular.",
        imagen: "../resultadosimgs/pesonormal/pesonormal.png",
      },
      {
        limite: 29,
        resultado: "Sobrepeso",
        consejo:
          "Reduce la ingesta de alimentos altos en calorías y aumenta el consumo de frutas y verduras. Puedes tener sobrepeso de musculo o grasa. Se recomienda siempre consultar a su nutricionista.",
        ejercicio:
          "Incorpora rutinas de ejercicio aeróbico y de fuerza para ayudar a perder peso y mejorar tu condición física.",
        imagen: "../resultadosimgs/sobrepeso/sobrepeso.jpg",
      },
      {
        limite: 39,
        resultado: "Obesidad grado I-II",
        consejo:
          "Consulta con un nutricionista para diseñar un plan de alimentación adecuado.",
        ejercicio:
          "Consulta con un entrenador personal para crear un programa de ejercicio seguro y efectivo.",
        imagen: "../resultadosimgs/obesidad/obesidad.jpg",
      },
      {
        limite: Infinity,
        resultado: "Obesidad grado III",
        consejo:
          "Es crucial buscar ayuda médica para abordar la obesidad grado III.",
        ejercicio:
          "Es fundamental trabajar con profesionales médicos y de ejercicio para abordar la obesidad grado III de manera segura y efectiva.",
        imagen: "../resultadosimgs/obesidadgrado3/obesidadgrado3.jpg",
      },
    ];

    const categoria = categoriasIMC.find((cat) => bmi < cat.limite);
    if (categoria) {
      recomendacionIMC.innerHTML = `<p>${categoria.resultado}</p>`;
      consejoNutricional.innerHTML = `<p>${categoria.consejo}</p>`;
      consejoEjercicio.innerHTML = `<p>${categoria.ejercicio}</p>`;
      insertarImagen(categoria.imagen);
    }
  }
};

const insertarImagen = (src) => {
  const imageContainer = document.getElementById("imageContainer");
  imageContainer.innerHTML = `<img src="${src}" alt="Recomendación de IMC">`;
};