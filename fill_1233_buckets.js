/**
 * Given an int, return the value at position idx in the sequence 1,2,3,3 1,2,3,3
 * Why tho? This is a special use case for a project that had three "buckets". Place one item in the first bucket, one item in the second bucket, and two items in the third bucket. Obviously easier with a simple MOD and ternary operator, but that's less fun.
 * @param {number} idx The position of the sequence
 * @returns {number}
 */
function cycle_every_fourth(idx)
{
    // idx & 3 is synonymous to idx % 4. There is no performance advantage. See below for the
    // At idx 4, the &3 + 1 result is 4. Shifting 4 bitwise right will result in 1, which is then multiplied by 3.
    return (idx & 3) + ((((idx - 1) & 3) + 1) >> 2) * 3;
}

(
    () =>
    {
        //*
        // Get 20 results from the sequencer
        for(let _i = 1; _i < 20; _i ++)
        {
            // Log the result
            console.log(cycle_every_fourth(_i));
        }

        /*/

        const iterations = 1000000;

        console.time('Time cost of MOD 4');

        for(let _i = 0; _i < iterations; _i ++)
        {
            _i % 4;
        }

        console.timeEnd('Time cost of MOD 4');

        console.time('Time cost of Bitwise AND');

        for(let _i = 0; _i < iterations; _i ++)
        {
            _i & 3;
        }

        console.timeEnd('Time cost of Bitwise AND');

        //*/
    }
)();
