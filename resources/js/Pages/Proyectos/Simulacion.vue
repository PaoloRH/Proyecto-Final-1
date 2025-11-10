<template>
  <div
    class="relative min-h-screen w-full flex flex-col items-center justify-start transition-all duration-500 overflow-hidden"
    :class="bgClase"
  >
    <div class="relative w-full max-w-6xl mx-auto flex items-center justify-between px-8 py-6 z-20">
      
      <Link
        :href="route('proyectos.index')"
        class="bg-gray-200 text-gray-800 py-2 px-4 rounded-lg shadow hover:bg-gray-300 transition-all duration-300 flex items-center gap-2"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        Volver
      </Link>

      <h2 class="text-3xl font-bold text-center text-indigo-700 absolute left-1/2 -translate-x-1/2">
        Simulación de Proyectos
      </h2>

      <button
        type="submit"
        @click="calcular" 
        class="bg-indigo-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
        :disabled="calculando"
      >
        {{ calculando ? "Calculando..." : "Calcular Promedio" }}
      </button>
    </div>

    <form
      @submit.prevent="calcular"
      class="p-8 rounded-xl shadow-lg max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-10 mt-8 relative z-10 transition-colors duration-300"
      :class="[formBgClase, calculando ? 'pointer-events-none' : '']"
    >
      
      <!-- Sección General -->
      <div class="space-y-6 rounded-xl p-6 transition-colors duration-300" :class="cajaClase">
        <h3 class="text-xl font-semibold text-gray-700 border-b pb-3">
          General
        </h3>

        <div v-for="campo in camposNumericos" :key="campo.name">
          <label :for="campo.name" class="block text-sm font-semibold text-gray-800 mb-1">
            {{ campo.label }}
          </label>
          <input
            v-model.number="form[campo.name]"
            type="number"
            :id="campo.name"
            class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 transition-all duration-300"
            :class="calculando ? 'bg-transparent border-transparent' : 'bg-white'"
            required
            step="0.1"
            min="0"
            max="20"
          />
        </div>
      </div>

      <!-- Sección Evaluaciones Dinámicas -->
      <div class="space-y-6 rounded-xl p-6 transition-colors duration-300" :class="cajaClase">
        <h3 class="text-xl font-semibold text-gray-700 border-b pb-3">
          Evaluaciones Dinámicas
        </h3>

        <div v-for="campo of evaluaciones" :key="campo.name">
          <div class="flex justify-between items-center mb-3">
            <label class="text-sm font-semibold text-gray-800">{{ campo.label }}</label>
            <div class="flex gap-2">
              <button type="button" @click="form[campo.name].push(0)" class="bg-green-500 text-white text-sm px-3 py-1 rounded hover:bg-green-600 transition-all duration-300">+ Agregar</button>
              <button type="button" @click="eliminarUltimo(campo.name)" class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600 transition-all duration-300">Eliminar ×</button>
            </div>
          </div>

          <div class="flex flex-wrap gap-3">
            <input
              v-for="(valor, i) in form[campo.name]"
              :key="campo.name + i"
              v-model.number="form[campo.name][i]"
              type="number"
              min="0"
              max="20"
              step="0.1"
              class="w-24 text-center border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-indigo-500 text-gray-800 transition-all duration-300"
              :class="calculando ? 'bg-transparent border-transparent' : 'bg-white'"
              required
            />
          </div>
        </div>
      </div>
    </form>

    <transition name="fade">
      <div v-if="calculando" class="absolute inset-0 flex flex-col items-center justify-center text-white text-4xl font-bold z-40 bg-black bg-opacity-5 backdrop-blur-sm">
        Calculando...
      </div>
    </transition>

    <transition name="fade">
      <div
        v-if="resultado && mostrarResultado"
        class="absolute inset-0 flex flex-col items-center justify-center backdrop-blur-md text-center p-10 z-40"
        :class="resultado.estado === 'finalizado' ? 'bg-green-600 bg-opacity-90' : 'bg-red-600 bg-opacity-90'"
      >
        <h1 class="text-6xl font-bold mb-4 text-white">
          {{ resultado.estado }}
        </h1>
        <p class="text-3xl font-semibold text-white">
          Promedio Final: {{ resultado.score_final }} / 20
        </p>

        <button
          @click="cerrarResultado"
          type="button"
          class="mt-10 bg-indigo-600 text-white py-2 px-6 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
        >
          Simular de nuevo
        </button>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import { router, Link } from "@inertiajs/vue3";

const form = reactive({
  avance: "",
  calidad: "",
  asistencia_equipo: "",
  entrega_final: "",
  revision_cliente: "",
  hito_1: [0],
  hito_2: [0],
  hito_3: [0],
  hito_4: [0],
});

const resultado = ref(null);
const calculando = ref(false);
const mostrarResultado = ref(false);
const bgClase = ref("bg-white"); 
const formBgClase = ref("bg-white"); 
const cajaClase = ref("bg-white"); 

const camposNumericos = [
  { name: "avance", label: "Avance" },
  { name: "calidad", label: "Calidad" },
  { name: "asistencia_equipo", label: "Asistencia" },
  { name: "entrega_final", label: "Entregable" },
  { name: "revision_cliente", label: "Examen Final" },
];

const evaluaciones = [
  { name: "hito_1", label: "Hito 1" },
  { name: "hito_2", label: "Hito 2" },
  { name: "hito_3", label: "Hito 3" },
  { name: "hito_4", label: "Hito 4" },
];

const cerrarResultado = () => {
  mostrarResultado.value = false;
  resultado.value = null;
  bgClase.value = "bg-white";
  formBgClase.value = "bg-white";
  cajaClase.value = "bg-white"; 

  form.avance = "";
  form.calidad = "";
  form.asistencia_equipo = "";
  form.entrega_final = "";
  form.revision_cliente = "";
  form.hito_1 = [0];
  form.hito_2 = [0];
  form.hito_3 = [0];
  form.hito_4 = [0];
};

const eliminarUltimo = (campo) => {
  if (form[campo].length > 1) form[campo].pop();
};

const animarPantalla = (estado) => {
  const colores = ["bg-green-500", "bg-orange-400", "bg-red-500"];
  let i = 0;
  calculando.value = true;
  mostrarResultado.value = false;

  formBgClase.value = "bg-transparent"; 
  cajaClase.value = "bg-transparent"; 

  const intervalo = setInterval(() => {
    bgClase.value = colores[i];
    i = (i + 1) % colores.length;
  }, 150); 

  setTimeout(() => {
    clearInterval(intervalo);

    if (estado === "finalizado") {
      bgClase.value = "bg-green-100";
      formBgClase.value = "bg-green-50";
      cajaClase.value = "bg-green-50";
    } else {
      bgClase.value = "bg-red-100";
      formBgClase.value = "bg-red-50";
      cajaClase.value = "bg-red-50";
    }

    calculando.value = false;
    setTimeout(() => (mostrarResultado.value = true), 300);
  }, 3000);
};

const calcular = () => {
  router.post(route("proyectos.simulacion.calcular"), form, {
    onSuccess: (page) => {
      resultado.value = page.props.resultado || null;
      if (resultado.value) {
        animarPantalla(resultado.value.estado);
      } else {
        calculando.value = false;
        bgClase.value = "bg-white";
        formBgClase.value = "bg-white";
        cajaClase.value = "bg-white";
      }
    },
    onError: () => {
      calculando.value = false;
      bgClase.value = "bg-white";
      formBgClase.value = "bg-white";
      cajaClase.value = "bg-white";
    }
  });
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.6s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
