export default function AppDateTime() {
    let date = new Date();
    let dateDisplay = date.toLocaleDateString("fr-FR", { weekday: 'long', day:'2-digit', month:'long', year:'numeric'});
    let timeDisplay = date.toLocaleTimeString("fr-FR", {hour:'2-digit', minute:'2-digit'});
    return (
        <>
            <span className="date">{dateDisplay}</span> | <span className="time">{timeDisplay}</span>
        </>
    );
}
