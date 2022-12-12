export class Binary {

    #length;
    #data;
    #numberOfSections;
    #lastMaxIndex;

    constructor(size)
    {
        if (size <= 0n)
            throw new RangeError("Negative size " + size + " is not allowed.");

        this.#numberOfSections = Math.ceil(size / 64);
        this.#data = new BigUint64Array(this.#numberOfSections);
        this.#length = size;
        this.#lastMaxIndex = size % 64 - 1;
        if (this.#lastMaxIndex === -1)
            this.#lastMaxIndex = 63;

    }

    get length() {
        return this.#length;
    }

    get(index) {
        if (index >= this.#length)
            throw new RangeError("Index " + index + " out of range for length " + this.#length);

        let section = Math.floor(index / 64);
        let position = index - section * 64;

        let mask = 1n;

        for (let i = 63 - position; i > 0; i--)
        {
            mask <<= 1n;
        }

        return ((this.#data[section] & mask) !== 0n) ? 1n: 0n;

    }

    set(index, value)
    {
        if (index >= this.#length)
            throw new RangeError("Index " + index + " out of range for length " + this.#length);

        if (value > 1n)
            throw new RangeError("Value " + value + " out of range for bounds [0, 1]");

        let section = Math.floor(index / 64);
        let position = index - section * 64;

        let mask = 1n;

        for (let i = 63 - position; i > 0; i--)
        {
            mask <<= 1n;
        }
        
        this.#data[section] = (this.#data[section] & ~mask) + value * mask;
    }





    


    static toBinaryString(bigUint64)
    {
        let mask = new BigUint64Array(1);
        mask[0] = BigInt("0x0000000000000001");

        let binary = [];

        for (let i = 0n; i < 64n; i++)
        {
            binary.push(((bigUint64 & mask[0]) === 0n) ? "0":"1");
            mask[0] <<= 1n;
        }

        return binary.reverse().join("");
    }

}