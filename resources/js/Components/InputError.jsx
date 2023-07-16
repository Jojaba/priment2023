export default function InputError({ message, className = '' }) {
    return message ? <span className={className}>{message}</span> : null;
}
