<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <Head title="Registro | TecnoSoluciones S.A." />

  <main class="container">
    <!-- Lado izquierdo -->
    <section class="brand-card">
      <div class="logo">
        <!-- Logo con degradado corporativo -->
        <svg class="logo-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="g" x1="0" x2="1" y1="0" y2="1">
              <stop offset="0" stop-color="#36C9A9" />
              <stop offset="1" stop-color="#4277BD" />
            </linearGradient>
          </defs>
          <rect width="100" height="100" rx="18" fill="url(#g)" />
          <path d="M30 50 L50 30 L70 50 L50 70 Z" fill="#ffffff" opacity="0.9" />
        </svg>

        <div>
          <div class="brand-title">TECNOSOLUCIONES S.A.</div>
          <div class="brand-sub">Registro de nuevos usuarios</div>
        </div>
      </div>

      <p class="hero">
        Únete a nuestra plataforma 💡<br />
        Gestiona tus proyectos y clientes de forma eficiente y moderna.
      </p>

      <p class="foot-note">
        © {{ new Date().getFullYear() }} TecnoSoluciones S.A. —  
        Innovación y gestión eficiente.
      </p>
    </section>

    <!-- Formulario -->
    <section class="form-card">
      <h1>Crear cuenta</h1>

      <form @submit.prevent="submit" novalidate>
        <div>
          <label for="name">Nombre</label>
          <input
            id="name"
            type="text"
            v-model="form.name"
            class="input"
            placeholder="Nombre completo"
            required
            autofocus
          />
          <div v-if="form.errors.name" class="error">{{ form.errors.name }}</div>
        </div>

        <div class="mt-4">
          <label for="email">Correo electrónico</label>
          <input
            id="email"
            type="email"
            v-model="form.email"
            class="input"
            placeholder="usuario@tecnosoluciones.cc"
            required
          />
          <div v-if="form.errors.email" class="error">{{ form.errors.email }}</div>
        </div>

        <div class="mt-4">
          <label for="password">Contraseña</label>
          <input
            id="password"
            type="password"
            v-model="form.password"
            class="input"
            placeholder="••••••••"
            required
          />
          <div v-if="form.errors.password" class="error">{{ form.errors.password }}</div>
        </div>

        <div class="mt-4">
          <label for="password_confirmation">Confirmar contraseña</label>
          <input
            id="password_confirmation"
            type="password"
            v-model="form.password_confirmation"
            class="input"
            placeholder="••••••••"
            required
          />
          <div v-if="form.errors.password_confirmation" class="error">
            {{ form.errors.password_confirmation }}
          </div>
        </div>

        <div class="mt-6 flex items-center justify-between">
          <Link href="/login" class="link">¿Ya tienes cuenta?</Link>

          <button type="submit" class="btn" :disabled="form.processing">
            {{ form.processing ? 'Registrando...' : 'Registrar' }}
          </button>
        </div>
      </form>
    </section>
  </main>
</template>

<style>
:root {
  --c1: #4c1b88;
  --c2: #4277BD;
  --c3: #36C9A9;
  --c4: #105293;
  --white: #ffffff;
  --radius: 16px;
  --shadow: 0 8px 28px rgba(0, 0, 0, 0.35);
  font-family: 'Poppins', system-ui, sans-serif;
}

html, body {
  height: 100%;
  width: 100%;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(-78deg, var(--c1), var(--c2), var(--c3), var(--c4));
  background-size: 300% 300%;
  animation: bgmove 12s ease infinite;
  overflow: hidden;
  color: var(--white);
}

@keyframes bgmove {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

body::before {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
  background-size: 100px 100px;
  z-index: 0;
  animation: float 60s linear infinite;
}
@keyframes float {
  from { transform: translate(0, 0); }
  to { transform: translate(-100px, -100px); }
}

.container {
  position: relative;
  z-index: 1;
  display: grid;
  grid-template-columns: 420px 1fr;
  gap: 36px;
  align-items: center;
  max-width: 980px;
  width: 100%;
  padding: 20px;
}

/* Tarjeta izquierda */
.brand-card {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255,255,255,0.15);
  backdrop-filter: blur(16px);
  border-radius: var(--radius);
  padding: 40px;
  box-shadow: var(--shadow);
  color: #e0f2f1;
  transition: all 0.3s ease;
}
.brand-card:hover {
  transform: translateY(-4px);
}

.logo {
  display: flex;
  align-items: center;
  gap: 14px;
}
.logo-svg {
  width: 56px;
  height: 56px;
  filter: drop-shadow(0 0 10px rgba(54,201,169,0.8));
}
.brand-title {
  font-size: 22px;
  font-weight: 700;
  color: var(--white);
}
.brand-sub {
  color: #cce4ff;
  font-size: 14px;
}

.hero {
  font-size: 15px;
  line-height: 1.6;
}

.foot-note {
  font-size: 12px;
  color: #cdeff0;
  margin-top: auto;
}

/* Formulario */
.form-card {
  background: rgba(255,255,255,0.92);
  backdrop-filter: blur(24px);
  border-radius: var(--radius);
  padding: 40px;
  box-shadow: var(--shadow);
  color: #2b2b2b;
  min-width: 380px;
  transition: all 0.3s ease;
}
.form-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 40px rgba(76, 27, 136, 0.3);
}

h1 {
  text-align: center;
  font-size: 26px;
  font-weight: 700;
  background: linear-gradient(90deg, var(--c2), var(--c3));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 20px;
}

/* Inputs */
label {
  display: block;
  font-size: 14px;
  color: var(--c1);
  margin-bottom: 6px;
}
.input {
  width: 100%;
  border: 1px solid rgba(66,119,189,0.4);
  border-radius: 10px;
  padding: 12px;
  font-size: 15px;
  transition: all 0.25s ease;
}
.input:focus {
  border-color: var(--c3);
  box-shadow: 0 0 10px rgba(54,201,169,0.3);
  outline: none;
}

/* Botón */
.btn {
  background: linear-gradient(90deg, var(--c2), var(--c3));
  color: var(--white);
  font-weight: 600;
  padding: 12px 16px;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  font-size: 16px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 18px rgba(66, 119, 189, 0.4);
}
.btn:hover {
  transform: scale(1.03);
  box-shadow: 0 6px 22px rgba(66, 119, 189, 0.6);
}
.btn:disabled {
  opacity: 0.6;
}

/* Enlace */
.link {
  color: var(--c3);
  font-weight: 500;
  text-decoration: none;
}
.link:hover {
  text-decoration: underline;
}

/* Error */
.error {
  color: #c62828;
  font-size: 13px;
  margin-top: 6px;
}

/* Responsive */
@media (max-width: 880px) {
  .container {
    grid-template-columns: 1fr;
  }
  .brand-card {
    order: 2;
    text-align: center;
  }
  .form-card {
    order: 1;
    min-width: unset;
  }
}
</style>
