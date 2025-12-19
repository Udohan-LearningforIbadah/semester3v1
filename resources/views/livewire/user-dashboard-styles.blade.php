<!--@include('livewire.user-dashboard-styles') -->
<style>
/* Responsive adjustments */
@media (max-width: 768px) {
    .calendar-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .calendar-header > div {
        width: 100%;
        justify-content: space-between;
    }
    
    .calendar-grid > div {
        min-height: 80px;
    }
}
</style>