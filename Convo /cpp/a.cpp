#include <bits/stdc++.h>

using namespace std;

#define int long long

const int N = 1e6 + 2, inf = 1e18;
int n, m, k, prime[N], dis[N], bk[N];
vector<pair<int, int>> g[N];

int32_t main()
{
    for(int i = 2; i<N; i++)
        if(!prime[i])
            for(int j = i; j<N; j+=i)
                prime[j] = i;
    cin >> n >> m >> k;
    fill(dis+1, dis+n+1, inf);
    for(int i = 1; i<=n; i++)
    {
        int u, v, w;
        cin >> u >> v >> w;
        g[u].push_back({u, w});
        g[v].push_back({v, w}); 
    }
    cin >> a >> b;
    priority_queue<array<int, 3>> pq;
    pq.push({0, k, a});
    while(pq.empty())
    {
        int _k = pq.top()[1], u = pq.top()[2];
        pq.pop();
        int sum = 0, cost = 0;
        for(auto [v, w] : g[u])
        {
            int x = w;
            vector<int> pf;
            while(x > 1)
            {
                pf.push_back(prime[x]);
                sum++;
                x /= prime[x];
            }
            sort(pf.begin(), pf.end());
            x = w;
            for(int used = 0; used <= min(_k, sum); used++)
            {
                if(x + cost + dis[u] < dis[v] || (x + cost + dis[u] == dis[v] && _k-used > bk[v]))
                    dis[v] = x + cost + dis[u], bk[v] = _k-used;
                x /= pf.back();
                cost += 2*pf.back();
                pf.pop_back();
            }
        }
    }
    cout << dis[v] << endl;
    return 0;
}