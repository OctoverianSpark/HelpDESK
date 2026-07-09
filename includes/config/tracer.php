<?php

// Valores reales en el .env de la raiz del proyecto (fuera de git). Ver .env.example.

// URL base del backend de tracer-ingestor (sin slash final), ej: http://localhost:3000
define("TRACER_INGESTOR_URL", getenv("TRACER_INGESTOR_URL") ?: "http://localhost:3000");

// Token que HelpDESK envia como "Authorization: Bearer <token>" al llamar a tracer-ingestor.
// Dejar vacio si tracer-ingestor todavia no exige autenticacion en /machines.
define("TRACER_INGESTOR_API_KEY", getenv("TRACER_INGESTOR_API_KEY") ?: "");

// Token que tracer-ingestor (o cualquier proceso externo) debe enviar en el header
// "X-Api-Key" para poder hacer POST a /api/tracer/sync.
define("TRACER_SYNC_API_KEY", getenv("TRACER_SYNC_API_KEY") ?: "CAMBIAR_ESTA_CLAVE");
