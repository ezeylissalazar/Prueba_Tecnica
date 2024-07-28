<script>
    function confirmAction(formId) {
        // Mostrar una alerta de confirmación
        const confirmed = confirm('¿Are you sure you want to perform this action?');
        if (confirmed) {
            // Si el usuario confirma, envía el formulario
            document.getElementById(formId).submit();
        }
    }
</script>