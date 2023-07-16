export default function Checkbox({ name, value, handleChange }) {
    return (
        <input
            type="checkbox"
            name={name}
            value={value}
            className=""
            onChange={(e) => handleChange(e)}
        />
    );
}
