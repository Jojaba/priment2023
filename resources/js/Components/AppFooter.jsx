export default function AppFooter() {
    const today = new Date();
    const year = today.getFullYear();
    return (
        <footer>
            <p><a href="">Mentions légales</a> | <a href="">Contact</a> | &copy; prim'ENT {year}</p>
        </footer>
    );
}
