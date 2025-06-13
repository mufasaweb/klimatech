# Klimatech - Gestión de Rutas y Relevamientos Técnicos

## Descripción

Sistema de gestión para la empresa Klimatech, dedicada a la visita y relevamiento de clientes con equipos de aire acondicionado. La aplicación permite a los administradores asignar rutas de visitas a técnicos, quienes luego completan checklists, dejan observaciones y suben fotos desde una app móvil que funciona tanto online como offline.

---

## Funcionalidades Principales

- **Administración de rutas:** El administrador crea rutas de visitas, asigna técnicos, define fechas y clientes.
- **App para técnicos:** Visualización de rutas asignadas. Al llegar a cada cliente, el técnico completa un checklist, puede dejar observaciones y adjuntar fotos como evidencia.
- **Soporte offline:** La app permite operar sin conexión a internet. Al recuperar la conexión, los datos se sincronizan automáticamente.
- **Gestión de informes:** El administrador puede visualizar y gestionar los informes enviados por los técnicos tras cada visita.

---

## Roles

- **Administrador:**  
  - Crea y asigna rutas de visitas.
  - Gestiona técnicos y clientes.
  - Visualiza y administra informes de visitas.

- **Técnico:**  
  - Visualiza sus rutas y visitas asignadas en el móvil.
  - Completa checklists, deja observaciones y sube fotos.
  - Opera en modo offline cuando es necesario.

---

## Stack Tecnológico

- **Backend:** PHP puro, utilizando librerías externas y recursos por CDN según se requiera.
- **Frontend:** Aplicación móvil (posiblemente PWA), centrada en simplicidad y capacidad offline.
- **Base de datos:** (A definir, sugerido: MySQL o SQLite para facilidad de integración con PHP).
- **Sincronización:** Manejo de datos offline y sincronización automática al recuperar conexión.

---

## Estructura Inicial del Proyecto

- `/admin` - Panel de administración.
- `/tecnico` - Interfaz/app para técnicos.
- `/api` - Endpoints para comunicación entre frontend y backend.
- `/docs` - Documentación del proyecto.

---

## Próximos Pasos

1. Definir estructura de la base de datos.
2. Armar el checklist estándar para visitas técnicas.
3. Especificar el flujo de sincronización offline/online.
4. Diseñar la interfaz inicial para admin y técnicos.

---

## Notas

- El proyecto se desarrollará progresivamente, priorizando funcionalidades mínimas viables y robustez en el soporte offline.
- Se utilizarán librerías JS y CSS desde CDN para facilitar la integración y mantener el stack liviano.

---

## Autores

- Equipo Klimatech & mufasaweb